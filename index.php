<?php
class SearchEngine
{
  //member variables
  private $btnLabel = '';
  private $btnStyle = array();
  private $searchPattern1 = '';
  private $searchPattern2 = '';
  private $postType = '';

  //constructor
  public function searchEngine($inputLabel, $inputStyle, $inputType, $inputPattern1, $inputPattern2){
    $this->btnLabel = $inputLabel;
    $this->btnStyle = $inputStyle;
    $this->searchPattern1 = $inputPattern1;
    $this->searchPattern2 = $inputPattern2;
    $this->postType = $inputType;
  }

  public function displayButton(){
    //build text to generate uniform button
    $result = '<input type="submit" name="search_eng" value="';
    $result .= $this->btnLabel;
    $result .= '" class="';
    $result .= implode(' ', $this->btnStyle);
    $result .= '" />';

    return $result;
  }

  public function doSearch($searchBox){
    //gets called when a search is actually performed, technically upon page reload
    $url = $this->searchPattern1;
    switch($this->postType){
      case 'raw':
        $url .= $searchBox;
        break;
      case 'plus':
        $url .= str_replace(' ','+',$searchBox);
        break;
    }
    $url .= $this->searchPattern2;
    header('location:'.$url);
    die('no-go');
  }
}

//The master list of search engines.  Customizable.
$search_engines = array(
'Google' => new SearchEngine(
  'Google',array('btn','btn-primary'),'plus',
  'https://www.google.com/search?q=',''),
'Instructables' => new SearchEngine(
  'Instructables',array('btn','btn-primary'),'plus',
  'http://www.instructables.com/howto/',''),
'G-images' => new SearchEngine(
  'G-images',array('btn','btn-primary'),'plus',
  'https://www.google.com/search?q=','&tbm=isch'),
'PHP' => new SearchEngine(
  'PHP',array('btn','btn-primary'),'plus',
  'http://php.net/manual-lookup.php?pattern=','&scope=quickref'),
'StackOverflow' => new SearchEngine(
  'StackOverflow',array('btn','btn-primary'),'plus',
  'http://stackoverflow.com/search?tab=votes&q=',''),
'Github' => new SearchEngine(
  'Github',array('btn','btn-primary'),'raw',
  'http://www.github.com/','')
);

//Code triggered when data has been posted.
//The doSearch function will generate a "location" header, so we want to execute this before any data has been sent
if(isset($_POST['search_eng'])){
  if(isset($search_engines[$_POST['search_eng']])){
    $thisEng = $search_engines[$_POST['search_eng']];
    $thisEng->doSearch($_POST['search_input']);
  }
}

?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript"
   src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
  </script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Productivity home</title>
</head>
<body>
  <div class='pad'>
  <form name="main" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" />
  <input type="text" name="search_input" class='searchbox' autofocus />
  <?php
  //Call the button generation code for each button in the set
  foreach($search_engines as $name=>$engine){
    print $engine->displayButton();
  } ?>
  </form />
  </div />
</body>
</html>
