from urllib import parse
from decimal import Decimal
from bs4.element import Tag
import requests
import os
import pymysql
from collections import Counter
from bs4 import BeautifulSoup
import time
import json
from enum import Enum

MAIN_URL = "https://sis.rpi.edu"

def conditions_restrictions(data):
    return data.startswith("Restrictions:")

def enter_restrictions(course, data):
    return CStatus.REST

def get_restriction_name(data):
    data = data.strip(" ")
    searchIndex = data.find("following ")
    assert(searchIndex != -1)
    return data[(searchIndex + 9):-1].strip(" ")

def conditions_coreq(data):
    return data.startswith("Corequisites:")

def enter_coreq(course, data):
    return CStatus.COREQ

def conditions_prereq(data):
    return data.startswith("Prerequisites:")

def enter_prereq(course, data):
    return CStatus.PREREQ

def parse_coreq(course, data):
    data = ' '.join(data.split())
    data = data.strip(" ")
    assert(len(data.split()) == 2)
    course["coreq"] = data

def parse_prereq(course, data):
    origData = data
    if not (data.find("$") == -1 and data.find("|") == -1 and data.find("&") == -1):
        print(course)
        print(data)
    assert(data.find("$") == -1 and data.find("|") == -1 and data.find("&") == -1)
    data = data.strip(" ")
    data = data.replace("Undergraduate level", '')
    data = data.replace("Graduate level", '')
    data = data.replace("Prerequisite Override ", "$")
    data = data.replace("%", "@")
    data = data.replace("(", " ( ")
    data = data.replace(")", " ) ")
    data = ' '.join(data.split())
    splitData = data.split("Minimum Grade of ")
    for i in range(1, len(splitData)):
        splitSpaces = splitData[i].strip(" ").split(" ")
        splitSpaces.pop(0)
        splitData[i] = " ".join(splitSpaces)
    data = " ".join(splitData)
    data = ' '.join(data.split())
    splitData = data.split(" ")
    checkedWord = False
    i = 0
    validChars = ["(", ")"]
    validStarts = ("$")
    while i < len(splitData):
        if checkedWord:
            checkedWord = False
            assert((len(splitData[i]) == 4 and splitData[i].isdigit()) or (splitData[i][len(splitData[i]) - 1] == "@" and (len(splitData[i]) == 1 or splitData[i][:-1].isdigit())))
            splitData[i - 1] = splitData[i - 1] + "_" + splitData[i]
            splitData.pop(i)
            i -= 1
        elif len(splitData[i]) == 4 and not splitData[i].startswith("$"):
            if not splitData[i].isupper():
                print(splitData[i])
            assert(splitData[i].isupper())
            checkedWord = True
        else:
            if splitData[i] == "and":
                splitData[i] = "&"
            elif splitData[i] == "or":
                splitData[i] = "|"
            elif splitData[i] not in validChars and not splitData[i].startswith(validStarts):
                print(data)
                print(origData)
                assert(False)

            checkedWord = False
        i += 1
    # splitData = data.split("Prerequisite Override")
    # for i in range(1, len(splitData)):
    #     splitSpaces = splitData[i].strip(" ").split(" ")
    #     splitSpaces[0] = "@" + splitSpaces[0]
    #     splitData[i] = " ".join(splitSpaces)
    # data = " ".join(splitData).replace("/  +/g", ' ')
    course["prereq"] = ' '.join(splitData)

def get_credit_value(data):
    creditLow = ""
    creditHigh = ""
    
    credit = ' '.join(data.split())

    creditSplit = credit.strip(' ').split(" ")
    if len(creditSplit) == 1:
        creditLow = creditSplit[0]
        creditHigh = creditSplit[0]
    else:
        assert(len(creditSplit) == 3)
        creditLow = creditSplit[0]
        creditHigh = creditSplit[2]
    assert(Decimal(creditLow) % 1 == 0 and Decimal(creditHigh) % 1 == 0)
    return (str(Decimal(creditLow).to_integral_value()), str(Decimal(creditHigh).to_integral_value()))

def conditions_credit(data):
    return data.endswith("Credit hours")

def enter_credit(course, data):
    credit = data.replace("Credit hours", '')
    res = get_credit_value(credit)
    course["credit_credit"] = res

def conditions_lecture(data):
    return data.endswith("Lecture hours")

def enter_lecture(course, data):
    credit = data.replace("Lecture hours", '')
    res = get_credit_value(credit)
    course["credit_lecture"] = res

def conditions_lab(data):
    return data.endswith("Lab hours")

def enter_lab(course, data):
    credit = data.replace("Lab hours", '')
    res = get_credit_value(credit)
    course["credit_lab"] = res

def conditions_other(data):
    return data.endswith("Other hours")

def enter_other(course, data):
    credit = data.replace("Other hours", '')
    res = get_credit_value(credit)
    course["credit_other"] = res

def conditions_level(data):
    return data.startswith("Levels:")

def enter_level(course, data):
    assert(len(course["levels"]) == 0)
    course["levels"] = data.replace("Levels:", '').strip(' ').split(', ')

def conditions_department(data):
    return data.endswith('Department')

def enter_department(course, data):
    assert(course["department"] == '')
    course["department"] = data

def conditions_schedule_types(data):
    return data.startswith("Schedule Types:")

def enter_schedule_types(course, data):
    course["schedule_types"] = data.replace('Schedule Types:', '').strip(' ').split(', ')

def conditions_course_attributes(data):
    return data.startswith("Course Attributes:")

def enter_course_attributes(course, data):
    course["course_attributes"] = data.replace('Course Attributes:', '').strip(' ').split(', ')
    return CStatus.ATTRIBUTE

class CStatus(Enum):
    NORMAL = 0
    PREREQ = 1
    REST = 2
    ATTRIBUTE = 3
    COREQ = 4

def get_prefixes(update=False):
    if not os.path.isdir("main-data"):
        os.mkdir("main-data")
    if update or not os.path.isfile("main-data/prefixes.txt"):
        page = requests.get("http://catalog.rpi.edu/content.php?catoid=21&navoid=521")
        fPage = open("main-data/prefix-site.txt", "w")
        fPage.write(page.text)
        fPage.close()
    f = open("main-data/prefix-site.txt", "r")
    page = f.read()
    f.close()
    soup = BeautifulSoup(page, 'html5lib')
    prefixes = soup.find_all(id="courseprefix")[0].find_all("option")
    prefix_list = []
    for i in range(1, len(prefixes)):
        prefix_list.append(prefixes[i].string)
    f = open("main-data/prefixes.txt", "w")
    for prefix in prefix_list:
        f.write(prefix + "\n")
    f.close()
    return prefix_list

def update_course_listing(prefix, semester, update=False, write=False):
    if update or not os.path.isfile("main-data/" + prefix + "/" + semester + "/" + "page.txt"):
        print("updating")
        if not os.path.isdir("main-data/" + prefix + "/" + semester):
            os.makedirs("main-data/" + prefix + "/" + semester)
        page = requests.get("https://sis.rpi.edu/rss/bwckctlg.p_display_courses?term_in=" + semester + "&one_subj=" + prefix + "&sel_crse_strt=0000&sel_crse_end=9999&sel_subj=&sel_levl=&sel_schd=&sel_coll=&sel_divs=&sel_dept=&sel_attr=")
        f = open("main-data/" + prefix + "/" + semester + "/" + "page.txt", "w")
        f.write(page.text)
        f.close()
    f = open("main-data/" + prefix + "/" + semester + "/" + "page.txt", "r")
    page = f.read()
    f.close()
    #data is malformed, use html5lib for all SIS pages (:
    soup = BeautifulSoup(page, 'html5lib')
    table = soup.find_all(class_="datadisplaytable", attrs={"summary": "This table lists all course detail for the selected term."})
    if len(table) != 1:
        print("Error: found unexpected number of ddts for prefix: " + prefix)
        return
    table = table[0]
    urls = []
    if table.tbody:
        table = table.tbody
    items = table.find_all("tr")
    for item in items:
        td = item.find_all("td", class_="nttitle")
        if td:
            for td_item in td:
                a = td_item.find_all("a")
                for a_item in a:
                    if not a_item["href"].startswith("/rss/bwckctlg.p_disp_course_detail?cat_term_in="):
                        print("Unknown data found for prefix: " + prefix)
                        print(a_item["href"])
                    else:
                        urls.append(a_item["href"])
    if write:
        if not os.path.isdir("main-data/" + prefix + "/" + semester):
            os.makedirs("main-data/" + prefix + "/" + semester)
        fUrls = open("main-data/" + prefix + "/" + semester + "/" + "urls.txt", "w")
        for url in urls:
            fUrls.write(url + "\n")
        fUrls.close()
    return

def collect_course_data(prefix, semester, update=False):
    if update or not os.path.isdir("course-data/" + prefix + "/" + semester):
        if not os.path.isfile("main-data/" + prefix + "/" + semester + "/" + "urls.txt"):
            return
        os.makedirs("course-data/" + prefix + "/" + semester)
        f = open("main-data/" + prefix + "/" + semester + "/" + "urls.txt", "r")
        urls = f.readlines()
        for url in urls:
            parsed_url = parse.parse_qs(parse.urlparse(url).query)
            if str(parsed_url['cat_term_in'][0]) != semester:
                print("Invalid semester: " + url)
                continue
            if str(parsed_url['subj_code_in'][0]) != prefix:
                print("Invalid prefix: " + url)
                continue
            course_number = str(parsed_url["crse_numb_in"][0]).strip("\n")
            curr_url = (MAIN_URL + url).strip("\n")
            print("URL: " + curr_url)
            page = requests.get((MAIN_URL + url).strip("\n"))
            fpage = open("course-data/" + prefix + "/" + semester + "/" + course_number + ".txt", "w")
            fpage.write(page.text)
            fpage.close()

def analyze_course_data(prefix, semester, number):
    course = dict()

    course["prefix"] = "" #
    course["number"] = "" #
    course["name"] = "" #
    course["credit_credit"] = (-1, -1) #
    course["credit_lecture"] = (-1, -1)
    course["credit_lab"] = (-1, -1)
    course['credit_other'] = (-1, -1)
    course["levels"] = [] #
    course["schedule_types"] = []
    course["restrictions"] = [] #[(Major, [a, b, c], T), (ASD, [b, c, d], F)] T = Must, F = may not
    course["department"] = ""
    course["course_attributes"] = [] #
    course["description"] = "" 
    course["prereq"] = "" #
    course["coreq"] = "" #
    course["semester"] = semester #

    if not os.path.isfile("course-data/" + prefix + "/" + semester + "/" + number + ".txt"):
        # print("File not found")
        # print("course-data/" + prefix + "/" + semester + "/" + number + ".txt")
        return
    f = open("course-data/" + prefix + "/" + semester + "/" + number + ".txt", "r")
    page = f.read()
    f.close()

    page = page.replace('&nbsp;', ' ')
    page = page.replace('\xa0', ' ')

    soup = BeautifulSoup(page, 'html5lib')
    table = soup.find_all('table', class_="datadisplaytable", attrs={"summary": "This table lists the course detail for the selected term."})
    if len(table) != 1:
        if len(table) == 0:
            print("Semester " + semester + ", " + prefix + "-" + number + " did not have a data table.")
        else:
            print("Semester " + semester + ", " + prefix + "-" + number + " had multiple data tables.")
        return
    table = table[0]
    title = table.find_all("td", class_="nttitle")
    if len(title) != 1:
        print(len(title))
        return
    title = title[0].text
    titleSplit = title.split(" ", maxsplit=3)
    if titleSplit[0] != prefix or titleSplit[1] != number:
        print("Semester " + semester + ", " + prefix + "-" + number + " had conflicting data (" + titleSplit[0] + "," + titleSplit[1] + ").")
        return
    course["prefix"] = titleSplit[0]
    course["number"] = titleSplit[1]
    course["name"] = titleSplit[3]
    course_info = table.find_all("td", class_="ntdefault")
    if len(course_info) != 1:
        if len(table) == 0:
            print("Semester " + semester + ", " + prefix + "-" + number + " did not have internal data.")
        else:
            print("Semester " + semester + ", " + prefix + "-" + number + " had multiple internal data fields.")
        return
    course_info = course_info[0]
    while course_info.span is not None:
        course_info.span.unwrap()
    while course_info.a is not None:
        course_info.a.unwrap()
    course_info = BeautifulSoup(str(course_info), 'html5lib')
    options = [(conditions_prereq, enter_prereq),
               (conditions_credit, enter_credit),
               (conditions_lecture, enter_lecture),
               (conditions_level, enter_level),
               (conditions_department, enter_department),
               (conditions_restrictions, enter_restrictions),
               (conditions_schedule_types, enter_schedule_types),
               (conditions_course_attributes, enter_course_attributes),
               (conditions_coreq, enter_coreq),
               (conditions_lab, enter_lab),
               (conditions_other, enter_other)]
    status = CStatus.NORMAL
    BLACKLIST = ['', 'Syllabus Available']
    br_count = 0
    rest_index = -1
    first_iteration = True
    for item in course_info.strings:
        origItem = item
        item = item.strip('\n')
        item = item.strip(' ')
        if first_iteration and item != '' and not item.endswith("Credit hours"):
            course["description"] = item
            continue
        first_iteration = False
        if status == CStatus.REST:
            if origItem.startswith('\n'):
                br_count += 1
            if item == '':
                br_count += 1
                if br_count >= 2:
                    status = CStatus.NORMAL
                    br_count = 0
            else:
                if origItem.endswith('\n'):
                    br_count = 1
                else:
                    br_count = 0
                if item.startswith("Must be enrolled"):
                    rest_index = len(course["restrictions"])
                    course["restrictions"].append((get_restriction_name(item), [], True))
                elif item.startswith("May not be enrolled"):
                    rest_index = len(course["restrictions"])
                    course["restrictions"].append((get_restriction_name(item), [], False))
                else:
                    assert(rest_index != -1)
                    course["restrictions"][rest_index][1].append(item)
        elif status == CStatus.ATTRIBUTE:
            if origItem.startswith('\n'):
                br_count += 1
            if item == '':
                br_count += 1
                if br_count >= 2:
                    status = CStatus.NORMAL
                    br_count = 0
            else:
                if origItem.endswith('\n'):
                    br_count = 1
                else:
                    br_count = 0
                for att in item.strip(' ').split(", "):
                    course["course_attributes"].append(att)
        elif item not in BLACKLIST:
            if status == CStatus.NORMAL:
                trigger = False
                for option in options:
                    if option[0](item):
                        trigger = True
                        res = option[1](course, item)
                        if res is not None:
                            status = res
                            if origItem.endswith('\n'):
                                br_count = 1
                            else:
                                br_count = 0
                if not trigger:
                    print(list(course_info.strings))
                    print("For " + prefix + ", " + semester + ", " + number + " Item doesn't meet a condition: " + item)
                    assert(False)
            elif status == CStatus.PREREQ:
                parse_prereq(course, item)
                status = CStatus.NORMAL
            elif status == CStatus.COREQ:
                parse_coreq(course, item)
                status = CStatus.NORMAL
    for level in course["course_attributes"]:
        if level.find("Minimum Grade") != -1:
            print(course)
            print(list(course_info.strings))
            assert(False)
    return course

def grab_course(course, imported_course, semester, loose=False):
    if course["grabbed"]:
        failed = False
        if course["prefix"] != imported_course["prefix"]:
            failed = 1
        if course["number"] != imported_course["number"]:
            failed = 2
        # if course["name"] != imported_course["name"]:
        #     failed = True
        if course["credit_credit"][0] != imported_course["credit_credit"][0] and course["credit_credit"][1] != imported_course["credit_credit"][1]:
            failed = 3
        if sorted(course["levels"]) != sorted(imported_course["levels"]):
            failed = 4
        if sorted(course["restrictions"]) != sorted(imported_course["restrictions"]):
            print("RestFail")
            failed = 5
        if sorted(course["course_attributes"]) != sorted(imported_course["course_attributes"]):
            failed = 6
        if course["prereq"] != imported_course["prereq"]:
            failed = 7
        if course["coreq"] != imported_course["coreq"]:
            failed = 8
        if failed:
            # print("Course " + course["prefix"] + " with ID " + course["number"] + " failed " + str(failed))
            course["data_conflict"].append(imported_course["semester"])
            if not loose:
                assert(False)
        # course["semesters"].append(semester)
    else:
        course["grabbed"] = True
        course["prefix"] = imported_course["prefix"] #
        course["number"] = imported_course["number"] #
        course["name"] = imported_course["name"] #
        course["credit_credit"] = imported_course["credit_credit"] #
        course["levels"] = imported_course["levels"] #
        course["restrictions"] = imported_course["restrictions"] #[(Major, [a, b, c], T), (ASD, [b, c, d], F)] T = Must, F = may not
        course["course_attributes"] = imported_course["course_attributes"] #
        course["prereq"] = imported_course["prereq"] #
        course["coreq"] = imported_course["coreq"] #
        course["semesters"] = []

def semester_combination(course_list, data):
    spring_semester = "202101"
    fall_semester = "202009"
    summer_semester = "202005"
    final_course_list = dict()
    for prefix in course_list:
        final_course_list[prefix] = dict()
        for number in course_list[prefix]:
            spring = False
            fall = False
            summer = False

            course = dict()

            course["grabbed"] = False
            course["prefix"] = "" # #1
            course["number"] = "" # #1
            course["name"] = "" # #1
            course["credit_credit"] = (-1, -1) # #1
            course["levels"] = [] # #2
            course["restrictions"] = [] #[(Major, [a, b, c], T), (ASD, [b, c, d], F)] T = Must, F = may not #2
            course["course_attributes"] = [] # #2
            course["prereq"] = "" # #
            course["coreq"] = "" #
            course["semesters"] = [] #
            course["data_conflict"] = []

            if fall_semester in data[prefix][number]:
                fall = True
                grab_course(course, data[prefix][number][fall_semester], "fall", loose=True)
            if spring_semester in data[prefix][number]:
                spring = True
                grab_course(course, data[prefix][number][spring_semester], "spring", loose=True)
            if summer_semester in data[prefix][number]:
                summer = True
                grab_course(course, data[prefix][number][summer_semester], "summer", loose=True)
            course.pop("grabbed")

            if "" in course["course_attributes"]:
                course["course_attributes"].remove("")

            final_course_list[prefix][number] = course
    return final_course_list
            
def analyze_semester_data(semester_file):
    if not os.path.isfile(semester_file):
        return None
    f = open(semester_file, "r")
    page = f.read()
    f.close()
    course_list = dict()
    soup = BeautifulSoup(page, 'html5lib')
    table = soup.find_all(class_="datadisplaytable", attrs={"summary": "This layout table is used to present the sections found"})
    assert(len(table) == 1)
    table = table[0]
    assert(table.tbody)
    table = table.tbody
    for child in table.children:
        if child.name == "tr":
            res = child.find_all("td")
            if len(res) > 3:
                prefix = res[2].text
                number = res[3].text
                if len(prefix) == 4 and len(number) == 4:
                    assert(prefix.isupper() and number.isdigit())
                    if prefix not in course_list:
                        course_list[prefix] = []
                    if number not in course_list[prefix]:
                        course_list[prefix].append(number)
    
    return course_list

def add_semester_info(data, semesters):
    for prefix in data:
        for number in data[prefix]:
            for semester in semesters:
                if prefix in semester[0] and number in semester[0][prefix]:
                    data[prefix][number]["semesters"].append(semester[1])

def db_course_upload(data):
    connection = pymysql.connect(host='localhost', user="vagrant", password="vagrant", db="website")
    restrictions = dict()
    course_attrib = []

    for prefix in data:
        for number in data[prefix]:
            if data[prefix][number]["prereq"] == "":
                data[prefix][number]["prereq"] = None
            if data[prefix][number]["coreq"] == "":
                data[prefix][number]["coreq"] = None
            for attrib in data[prefix][number]["course_attributes"]:
                if attrib not in course_attrib:
                    course_attrib.append(attrib)

    for prefix in data:
        for number in data[prefix]:
            foundLevel = False
            for restriction in data[prefix][number]["restrictions"]:
                if restriction[0] not in restrictions:
                    restrictions[restriction[0]] = []
                if restriction[0] == "Levels":
                    foundLevel = True
                for name in restriction[1]:
                    if name not in restrictions[restriction[0]]:
                        restrictions[restriction[0]].append(name)
            if not foundLevel and len(data[prefix][number]["levels"]) != 0:
                levelData = ["Levels", [], True]
                if "Levels" not in restrictions:
                    restrictions["Levels"] = []
                for level in data[prefix][number]["levels"]:
                    levelData[1].append(level)
                    if level not in restrictions["Levels"]:
                        restrictions["Levels"].append(level)
                data[prefix][number]["restrictions"].append(levelData)
    db_restriction_data = None
    db_attrib_data = None
    with connection.cursor() as cursor:
        cursor.execute("SELECT restrictions.name AS k, restriction_data.name AS v, restrictions.id AS i FROM restriction_data LEFT JOIN restrictions ON restriction_data.restriction_id = restrictions.id")
        db_restriction_data = cursor.fetchall()
        cursor.execute("SELECT * FROM attributes")
        db_attrib_data = cursor.fetchall()
    connection.commit()
    curr_restrictions_data = dict()
    curr_restrictions_id = dict()
    curr_attribute_id = dict()
    for row in db_restriction_data:
        if row[0] not in curr_restrictions_data:
            curr_restrictions_data[row[0]] = []
            curr_restrictions_id[row[0]] = row[2]
        if row[1] not in curr_restrictions_data[row[0]]:
            curr_restrictions_data[row[0]].append(row[1])
    for row in db_attrib_data:
        if row[1] not in curr_attribute_id:
            curr_attribute_id[row[1]] = row[0]
    for attrib in course_attrib:
        if attrib not in curr_attribute_id:
            with connection.cursor() as cursor:
                cursor.execute("INSERT INTO attributes (name) VALUES (%s)", (attrib))
            connection.commit()

    for restriction in restrictions:
        if restriction not in curr_restrictions_data:
            with connection.cursor() as cursor:
                cursor.execute("INSERT INTO restrictions (name) VALUES (%s)", (restriction))
                cursor.execute("SET @rest_id = LAST_INSERT_ID()")
                queue = []
                for name in restrictions[restriction]:
                    queue.append([name])
                cursor.executemany("INSERT INTO restriction_data (restriction_id, name) VALUES (@rest_id, %s)", queue)
            connection.commit()
        else:
            id = curr_restrictions_id[restriction]
            queue = []
            for name in restrictions[restriction]:
                if name not in curr_restrictions_data[restriction]:
                    queue.append([id, name])
            if len(queue) != 0:
                with connection.cursor() as cursor:
                    cursor.executemany("INSERT INTO restriction_data (restriction_id, name) VALUES (%s, %s)", queue)
                    db_restriction_data = cursor.fetchall()
                connection.commit()


    db_restriction_data = None
    db_attrib_data = None
    with connection.cursor() as cursor:
        cursor.execute("SELECT name, id FROM restriction_data")
        db_restriction_data = cursor.fetchall()
        cursor.execute("SELECT * FROM attributes")
        db_attrib_data = cursor.fetchall()
    connection.commit()
    curr_restrictions_id = dict()
    curr_attribute_id = dict()    
    for row in db_restriction_data:
        if row[0] not in curr_restrictions_id:
            curr_restrictions_id[row[0]] = row[1]
    for row in db_attrib_data:
        if row[1] not in curr_attribute_id:
            curr_attribute_id[row[1]] = row[0]
    for prefix in data:
        print("Running " + prefix)
        for number in data[prefix]:
            with connection.cursor() as cursor:
                cursor.execute("INSERT INTO courses (name) VALUES (%s)", (data[prefix][number]["name"]))
                cursor.execute("SET @course_id = LAST_INSERT_ID()")
                cursor.execute("INSERT INTO course_single (course_single_id) VALUES (@course_id)")
                cursor.execute("INSERT INTO course_single_catalog (course_single_id, prefix, number, credit_low, credit_high, prereq, coreq, semester_summer, semester_fall, semester_spring, sis_conflict_warning) VALUES (@course_id, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", (data[prefix][number]["prefix"], data[prefix][number]["number"], data[prefix][number]["credit_credit"][0], data[prefix][number]["credit_credit"][1], data[prefix][number]["prereq"], data[prefix][number]["coreq"], "summer" in data[prefix][number]["semesters"], "fall" in data[prefix][number]["semesters"], "spring" in data[prefix][number]["semesters"], len(data[prefix][number]["data_conflict"]) != 0))
                query = []
                for restriction in data[prefix][number]["restrictions"]:
                    for item in restriction[1]:
                        query.append([curr_restrictions_id[item], restriction[2]])
                cursor.executemany("INSERT INTO course_single_catalog_restrictions (course_single_id, restriction_id, required) VALUES (@course_id, %s, %s)", query)
                query = []
                for attribute in data[prefix][number]["course_attributes"]:
                    query.append([curr_attribute_id[attribute]])
                cursor.executemany("INSERT INTO course_single_catalog_attrib (course_single_id, attribute_id) VALUES (@course_id, %s)", query)
        connection.commit()
            
            
            #add name to courses, grab ID from courses, add to courses_single, 

if not os.path.isdir("main-data"):
    os.mkdir("main-data")

prefix = "CSCI"
semester = "202101"
number = ""
if number != "":
    print(analyze_course_data(prefix, semester, number))
    exit(0)

f = open("primary_course_final_semesters.json", "r")
final_set = json.loads(f.read())
f.close()

db_course_upload(final_set)

exit(0)

fall_data = analyze_semester_data("semester-data/Fall2020.html")
spring_data = analyze_semester_data("semester-data/Spring2021.html")
# print(fall_data)
summer_data = analyze_semester_data("semester-data/Summer2020.html")
semester_data = [(summer_data, "summer"), (fall_data, "fall"), (spring_data, "spring")]
# print(summer_data)


prefixes = get_prefixes()
semesters = ["202101", "202009", "202005"]
f = open("primary_course_list.json", "r")
course_list = json.loads(f.read())
f.close()
f = open("primary_course_data.json", "r")
course_data = json.loads(f.read())
f.close()

final_set = semester_combination(course_list, course_data)

add_semester_info(final_set, semester_data)

f = open("primary_course_final_semesters.json", "w")
f.write(json.dumps(final_set))
f.close()

# db_course_upload(final_set)

# for prefix in final_set:
#     for number in final_set[prefix]:
#         if len(final_set[prefix][number]["semesters"]) != 0:
#             print(final_set[prefix][number])


exit(0)
course_data = dict()
restrictions = dict()
course_attrib = []
levels = []
nCourses = []
for prefix in prefixes:
    print("Running " + prefix)
    course_list[prefix] = []
    course_data[prefix] = dict()
    if True:
        for semester in semesters:
            if os.path.isdir("course-data/" + prefix + "/" + semester):
                for file in os.listdir("course-data/" + prefix + "/" + semester):
                    number = file[:-4]
                    course = analyze_course_data(prefix, semester, number)
                    if number not in course_list:
                        course_list[prefix].append(number)
                    for rest in course["restrictions"]:
                        if rest[0] not in restrictions:
                            restrictions[rest[0]] = []
                        for item in rest[1]:
                            if item not in restrictions[rest[0]]:
                                restrictions[rest[0]].append(item)
                    for attrib in course["course_attributes"]:
                        if attrib not in course_attrib:
                            course_attrib.append(attrib)
                    for level in course["levels"]:
                        if level not in levels:
                            levels.append(level)
                    if course["credit_credit"][0] == -1 or course["credit_credit"][1] == -1:
                        nCourses.append(course)
                    if number not in course_data[prefix]:
                        course_data[prefix][number] = dict()
                    course_data[prefix][number][semester] = course
                    # print(analyze_course_data(prefix, semester, file[:-4]))
                # update_course_listing(prefix, semester, write=True)
                # collect_course_data(prefix, semester)
            else:
                print("Prefix " + prefix + " not found")

# f = open("primary_course_data.json", "w")
# f.write(json.dumps(course_data))
# f.close()

# f = open("primary_course_list.json", "w")
# f.write(json.dumps(course_list))
# f.close()

print("Finished!!!")
for course in nCourses:
    print(course)
print("End Course")
print(levels)
print(course_attrib)
print(restrictions)

time.sleep(30)
exit(0)

# connection = pymysql.connect(host='localhost', user="vagrant", password="vagrant", db="website")