<?PHP
//Sets the timezone and encoding
date_default_timezone_set('America/Chicago');
////////////////////////////////////////////////////////

//Functions
function getLinks() { $a=glob("*.csv"); return $a; } //glob gets all csv
function getCSV($FileName) {$data=array_map('str_getcsv', file($FileName));return $data;}

$Links=getLinks(); //Gets all the files and makes links from them.

echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Convert csv to PDF">';

if (isset($_REQUEST['file'])) { $FileName=explode('.',$_REQUEST['file']); echo '<title>'.$FileName[0].'</title>'; } else { echo '<title>Convert Rubric CSV Into PDF</title>'; }
echo '<link href="../css/SiteDefault.css" type="text/css" rel="stylesheet">
<style type="text/css">
  body { padding:1em; font-size:80%}
  .bold { font-weight:bold; }
  .color { background-color:tomato; }
  table,tr,td { break-inside:avoid-page; border-collapse:collapse; border:2px solid black; padding:1.0em; text-align:left;}
  .border { border-left:2px solid white; border-right:2px solid white; border-bottom:2px solid white;  }
  .top {border-top:20px solid black; }
  .name,.Cdescription,.points,.category,.description {font-weight:bold;}
  .num { text-align:right; }
  .name {font-size:100%;}
  .Cdescription {font-size:90%;}
  .hidden { display:none; }
  @media print { .noprint { visibility: hidden; } .hidden { display:block; } }
</style>
</head><body>';
//Display Links
echo '<nav id="nav" class="noprint">';
foreach ($Links as $v) { if (isset($_REQUEST['file']) && ($v==$_REQUEST['file'])) { $selected='class="selected"';}else{$selected='';} echo '<button name="file" value="'.$v.'" '.$selected.'>'.$v.'</button>'; }
echo '</nav>';

if (isset($_REQUEST['file'])) { 
  $csv=getCSV($_REQUEST['file']);
  echo '<p class="hidden">'.$_REQUEST['file'].'</p>';
  $col=count($csv[0]);//how many columns
  $Name=TRUE;//Set to distinguish the criterion name and criterian description
  $segments=1;//Set to determine if to create a new table or not.
  foreach ($csv as $a) {
      if ($a[0]!='It is recommended that you do not edit rubrics in spreadsheet format' AND str_starts_with($a[0],'v')===FALSE ) {  
        if ($segments===1) {echo '<table>'; $segments=2; }
        if (!empty($a[0])) { if ($Name===TRUE) { echo '<tr><td colspan="'.$col.'" class="name top">Criterion Name: '.$a[0].'</td></tr>'; $Name=FALSE; } else { echo '<tr><td colspan="'.$col.'" class="Cdescription">Criterion Description: '.$a[0].'</td></tr>'; $Name=TRUE; }  }
        else { 
          $max=count($a);
          if (is_numeric($a[1])) { echo '<tr><td class="points">Points</td>'; for ($i=1; $i<=$max-1; $i++) { echo '<td class="num">'.$a[$i].'</td>'; } echo '</tr>';  }
          elseif ($a[1]==='Advanced' OR $a[1]==='Proficient') { echo '<tr><td class="category">Category</td>'; for ($i=1; $i<=$max-1; $i++) { echo '<td class="num">'.$a[$i].'</td>'; } echo '</tr>'; }
          else { echo '<tr><td class="description">Description</td>'; for ($i=1; $i<=$max-1; $i++) { echo '<td>'.$a[$i].'</td>'; }  echo '</tr></table><br>'; $segments=1;}
        }
      }
  }
}


echo '</body></html>';
echo '<script>
const nav = document.getElementById("nav");
const link = document.getElementById("Students");
const items=window.location.href.split("/"); //Gets the href (address) of the current page
const CurrentLocation=items[items.length-1].split("?"); //Gets the filename and key-value pairs of the current page


nav.addEventListener("click", (event) => {
  const isButton = event.target.nodeName === "BUTTON";
  if (!isButton) { return; }
  window.location.href = CurrentLocation[0]+"?file="+event.target.value;
});

</script>';
