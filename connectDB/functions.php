<?php
require __DIR__ . '/dbconnect.php';

function fetchNews($conn)
{

    $request = $conn->prepare(" SELECT news_id, news_title, news_short_description, news_author, news_published_on FROM info_news ORDER BY news_published_on DESC ");
    return $request->execute() ? $request->fetchAll() : false;
}


function getAnArticle($id_article, $conn)
{

    $request =  $conn->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_image, news_author, news_published_on FROM info_news  WHERE news_id = ? ");
    return $request->execute(array($id_article)) ? $request->fetchAll() : false;
}


function getOtherArticles($differ_id, $conn)
{
    $request =  $conn->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_image, news_author, news_published_on FROM info_news  WHERE news_id != ? ORDER BY news_published_on DESC");
    return $request->execute(array($differ_id)) ? $request->fetchAll() : false;
}

function fetchStudents($conn)
{

    $request = $conn->prepare(" SELECT matric, name, quiz1, quiz2, assignment, project, final, attendance, total, grade FROM students ORDER BY matric ASC");
    return $request->execute() ? $request->fetchAll() : false;
}
function fetchStudent($class_id, $conn)
{

    $request = $conn->prepare(" SELECT matric, name, quiz1, quiz2, assignment, project, final, attendance, total, grade FROM " . $class_id . " ORDER BY matric ASC");
    return $request->execute() ? $request->fetchAll() : false;
}

function getStudent($classid, $matric, $conn)
{

    $request =  $conn->prepare(" SELECT matric, name, quiz1, quiz2, assignment, project, final, attendance, total, grade FROM " . $classid . "  WHERE matric = ? ");
    return $request->execute(array($matric)) ? $request->fetchAll() : false;
}