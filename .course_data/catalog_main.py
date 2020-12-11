import requests
import os
import pymysql
from collections import Counter
from bs4 import BeautifulSoup
def prereq(data):
    return ""
 
def whenoffered(data):
    return ""
 
def crosslist(data):
    return ""
 
def credithours(data):
    return ""
 
def contact(data):
    return ""
 
def graded(data):
    return ""
 

# connection = pymysql.connect(host='localhost', user="vagrant", password="vagrant", db="website")
dt = []
dw = dict()
for i in range(1, 21): #21
    fmain = open(str(i) + "plan.txt", "r")
    data = fmain.readlines()
    for x in range(0, len(data)): #len(data)
        fcourse = open(str(i) + "courses/" + str(x) + "data.txt", 'r')
        page = fcourse.read()
        soup = BeautifulSoup(page, 'html.parser')
        res = soup.find_all(id="course_preview_title")[0].text.strip()
        resArr = res.split(" ", maxsplit=3)
        otherInfo = str(soup.find_all(id="course_preview_title")[0].parent)
        # otherInfo.replace('<hr>', '')
        # print(otherInfo)
        otherInfoOrig = otherInfo
        # otherInfo = otherInfo.replace("<sup>", "")
        # otherInfo = otherInfo.replace("</sup>", "")
        # otherInfo = otherInfo.replace("<sub>", "")
        # otherInfo = otherInfo.replace("</sub>", "")
        # otherInfo = otherInfo.replace("<p>", "")
        # otherInfo = otherInfo.replace("</p>", "")
        # otherInfo = otherInfo.replace("<em>", "")
        # otherInfo = otherInfo.replace("</em>", "")
        # otherInfo = otherInfo.replace("<span>", "")
        # otherInfo = otherInfo.replace("</span>", "")
        # otherInfo = otherInfo.replace("<strong>", "")
        # otherInfo = otherInfo.replace("</strong>", "")
        otherInfo = otherInfo.replace(u'\xa0', ' ')
        otherInfo = otherInfo.replace('&#160;', ' ')
        otherInfo = otherInfo.replace("&nbsp;", " ")
        otherInfo2 = BeautifulSoup(otherInfo, 'html.parser')
        while otherInfo2.p is not None:
            otherInfo2.p.unwrap()
        while otherInfo2.sup is not None:
            otherInfo2.sup.unwrap()
        while otherInfo2.sub is not None:
            otherInfo2.sub.unwrap()
        while otherInfo2.em is not None:
            otherInfo2.em.unwrap()
        while otherInfo2.strong is not None:
            otherInfo2.strong.unwrap()
        while otherInfo2.a is not None:
            otherInfo2.a.unwrap()
        while otherInfo2.span is not None:
            otherInfo2.span.unwrap()
        otherInfo2 = BeautifulSoup(str(otherInfo2), 'html.parser')
        data2 = list(otherInfo2.strings)
        finalData = dict()
        resArr = data2[0].split(" ", maxsplit=3)
        finalData["prefix"] = resArr[0]
        finalData["number"] = resArr[1]
        finalData["title"] = resArr[3]
        #1 = desc, 2 = 
        skip_values = ['', '\n', ',', '.', ' ']
        params = ("Prerequisites/Corequisites:", "When Offered:", "Cross Listed:", "Credit Hours:", "Contact, Lecture or Lab Hours:", "Graded:")
        paramsKeys = ("prereq", "whenoffered", "crosslist", "credithours", "contact", "graded")
        paramsFunc = (prereq, whenoffered, crosslist, credithours, contact, graded)
        finalData["prereq"] = []
        finalData["whenoffered"] = []
        finalData["crosslist"] = []
        finalData["credithours"] = -1
        finalData["contact"] = -1
        finalData["graded"] = -1
        kill_params = ("Back to Top", "Print-Friendly Page (opens a new window)")
        readingDesc = True
        z = 1
        while z < len(data2):
            data2[z] = data2[z].strip(" ")
            data2[z] = data2[z].strip("\n")
            if data2[z].startswith(kill_params):
                break
            if data2[z] not in skip_values:
                if data2[z].startswith(params):
                    readingDesc = False
                    for q in range(0, len(params)):
                        if data2[z].startswith(params[q]):
                            if paramsKeys[q] == 'prereq':
                                print(data2[z])
                    if data2[z] in dw:
                        dw[data2[z]] += 1
                    else:
                        dw[data2[z]] = 1
                    break
                elif readingDesc:
                    if "desc" in finalData:
                        finalData["desc"] += '\n' + data2[z]
                    else:
                        finalData["desc"] = data2[z]
                else:
                    print("Error occured:")
                    print(data2[z])
                    print(data2)
                    # print(otherInfo2)
                    # print(data2)
            z += 1


            # if 
        # if(len(data2) > 2):
        #     data2[1] = data2[1].strip('\n')
        #     for z in range(2, len(data2)):
        #         data2[z] = data2[z].strip(" ")
        #         for d in data2:
        #             if 'https://rpi.acalogadmin.com' in d:
        #                 print(data2)
        #         if data2[2] != 'Prerequisites/Corequisites:' and 'Prerequisites/Corequisites:' in data2:
        #             print("oops1")
        #             print(otherInfo)
        #             print(data2)
        #             print(otherInfoOrig)
        #             print("oops2")
        #         if data2[z] in dw:
        #             dw[data2[z]] += 1
        #         else:
        #             dw[data2[z]] = 1
        # else:
        #     print("oops")
        #     print(data2)

            #[('Credit Hours:', 1821), ('When Offered:', 1624), ('Prerequisites/Corequisites:', 1198), ('4', 796), ('3', 743), ('Cross Listed:', 527), ('Spring term annually.', 422), ('Fall term annually.', 399), ('Fall and spring terms annually.', 212), ('Upon availability of instructor.', 148), ('1 to 4', 70), ('1', 61), ('2', 60), ('Contact, Lecture or Lab Hours:', 60), ('Spring term even-numbered years.', 51), ('Spring term odd-numbered years.', 46), ('Upon sufficient demand.', 43), ('', 42), ('Fall, spring, and summer terms annually.', 41), ('Fall term even-numbered years.', 36), ('Fall term odd-numbered years.', 34), ('Permission of instructor.', 31), ('1 to 9', 30), ('\n', 25), ('5', 23), ('0', 23), ('Prerequisite:', 22), (',', 20), ('1 to 3', 20), ('Variable', 19)]
        #0 = PREFIX, 1 = NUMBER, 3 = TITLE
        # if(len(resArr[0]) != 4 or len(resArr[1]) != 4):
        #     print("Skipping " + res)
        # else:
        #     try:
        #         with connection.cursor() as cursor:
        #             sql = "INSERT INTO courses (name) VALUES (%s)"
        #             cursor.execute(sql, (resArr[3]))
        #             sql = "SET @course_num = LAST_INSERT_ID()"
        #             cursor.execute(sql, ())
        #             sql = "INSERT INTO course_single (course_id, credit) VALUES (@course_num, -1)"
        #             cursor.execute(sql, ())
        #             sql = "INSERT INTO course_single_catalog (course_id, prefix, number) VALUES (@course_num, %s, %s)"
        #             cursor.execute(sql, (resArr[0], resArr[1]))
        #         connection.commit()
        #     except Exception as e:
        #         print("Error: " + res)
        #         print(e)
        #         exit(1)
        fcourse.close()
# print(Counter(dw).most_common(100))
# for i in range(1, 21):
#     fmain = open(str(i) + "plan.txt", "r")
#     data = fmain.readlines()
#     os.mkdir(str(i) + "courses")
#     for x in range(0, len(data)):
#         if data[x] != '':
#             page = requests.get('http://catalog.rpi.edu/' + data[x])
#             fcourse = open(str(i) + "courses/" + str(x) + "data.txt", 'w')
#             fcourse.write(page.text)
#             fcourse.close()

    # fmain = open(str(i) + "main.txt", "r")
    # page = fmain.read()
    # f = open(str(i) + "plan.txt", "w")
    # # page = requests.get("http://catalog.rpi.edu/content.php?catoid=21&catoid=21&navoid=521&filter%5Bitem_type%5D=3&filter%5Bonly_active%5D=1&filter%5B3%5D=1&filter%5Bcpage%5D=" + str(i) + "#acalog_template_course_filter")
    # soup = BeautifulSoup(page, 'html.parser')
    # resOne = soup.find_all(class_="width")
    # for resItem in resOne:
    #     # print(resItem)
    #     res = resItem.find_all("a", href=True)
    #     for a in res:
    #         f.write(a['href'] + '\n')
    #         # print(a['href'])
    # # print(soup.find_all(class_="width")[0])
    # # fmain.write(page.text)
    # f.close()
    # fmain.close()
