<?php
// Simple Markdown to HTML (headings and paragraphs only)
$file = 'sample.md';
if (!file_exists($file)) file_put_contents($file, "# Hello\nThis is a **markdown** file.\n");
$md = file_get_contents($file);
$html = preg_replace('/^# (.*)$/m', '<h1>$1</h1>', $md);
$html = preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $html);
$html = preg_replace('/^(?!<h1>)(.+)$/m', '<p>$1</p>', $html);
echo $html;
