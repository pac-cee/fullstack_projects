# Project 022: CSV Parser

## Description
Read a CSV file and display its contents as an HTML table.

## Learning Goals
- `fopen`, `fgetcsv`
- Loop through CSV rows
- Basic HTML table generation

## Code
See [data.csv](data.csv) and [index.php](index.php)

## Logic & Explanation
Open `data.csv`, read header row for table headings, then iterate through each row with `fgetcsv` adding table rows.
