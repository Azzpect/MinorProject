<?php
    require "db.php";
    $sql = "create table subjects(
    subjectName varchar(100),
    subjectCode varchar(10),
    questionYear year,
    primary key (subjectCode, questionYear));";
    $conn->query($sql);
    $sql = "create table questions(
    questionId varchar(10),
    question text,
    subjectCode varchar(10),
    questionYear year,
    primary key (questionId),
    foreign key (subjectCode, questionYear) references subjects(subjectCode, questionYear));"
    $conn->query($sql);
    $sql = "create table answers(
    answerId varchar(10),
    answer text,
    questionId varchar(10),
    primary key (answerId),
    foreign key (questionId));"
    $conn->query($sql);
?>