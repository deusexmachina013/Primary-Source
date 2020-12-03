INSERT into courses (name) VALUES (<VAL>);
SET @course_id = LAST_INSERT_ID();
INSERT INTO course_groups (course_group_id) VALUES (@course_id);
INSERT INTO course_groups_catalog (course_group_id) VALUES (@course_id);

INSERT INTO course_groups_catalog_data (course_group_id, course_id) VALUES (@course_id, <COURSE_GROUP_ID>);


INSERT INTO course_groups_catalog_data (course_group_id, course_id) SELECT @course_id, course_single_id FROM course_single WHERE prefix = <PREFIX> AND number = <NUMBER>;





