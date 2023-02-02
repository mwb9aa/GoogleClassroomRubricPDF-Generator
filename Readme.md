# Google Classroom Rubric to PDF Generator

Finds any csv's in the same folder as it is.
Uses the browsers built-in print to pdf mode.

Only accomodates 4 levels of descriptors (Advanced, Proficients, Developing, Basic)

I'm working on a pure JavaScript solution, so one doesn't need a webserver, but haven't had much time work on it.


## Pre-requisites
1. Install PHP (tested on version 8+)

## Installation
1. Copy convert.php to a working web directory with PHP installed.

## Usuage
1. Open a rubric created in Google Classroom.
2. Click the three vertical dots and select Export to Sheets.
3. Open the rubric in Google Sheets. (By default this is in My Drive->Classroom->Rubric Exports.)
4. Download the file as a csv. (Choose File->Download->Comma Separated Values (.csv).)
5. Place the downloaded file into the same directory as convert.php.
6. Use a web browser to navigate to wherever you placed convert.php.
7. Click the file you want to convert.
8. Print from your browser window and choose Save as PDF.
