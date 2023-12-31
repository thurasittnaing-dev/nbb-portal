<?php

# Menu Active
function menu_active($path)
{
    $currentPath = parse_url(url()->current(), PHP_URL_PATH);
    return strstr($currentPath, $path) ? "active" : "";
}

# Slug Generate
function make_slug($string)
{
    return str_replace(' ', '-', strtolower($string));
}

# video formats
function formats()
{
    $data = ['mp4', 'mkv', 'm3u8'];
    return $data;
}


# Make Folder
function make_folder($text, $year)
{
    $text = str_replace(" ", ".", $text);
    $text = str_replace(",", "", $text);
    $text = str_replace(":", "", $text);
    $text = str_replace("'", "", $text);
    $text = str_replace("#", "", $text);
    $text = str_replace("..", ".", $text);
    $text = str_replace("&", "And", $text);

    $text = $text .= ".$year";
    return $text;
}

# series folder
function series_folders()
{
    return ['Animation', 'China', 'ENG', 'India', 'Japan', 'Korea', 'Thai'];
}

# highlight keyword
function highlight_keyword($text, $keyword)
{
    $highlighted = '<span class="highlight">' . $keyword . '</span>';
    $text = str_ireplace($keyword, $highlighted, $text);
    return $text;
}

# roles
function roles()
{
    return ['admin', 'operator', 'subscriber'];
}
