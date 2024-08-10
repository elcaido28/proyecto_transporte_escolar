
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title></title>



<link href="https://www.jqueryscript.net/css/jquerysctipttop.css?v3" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<style>
body { min-height: 100vh;  font-family: 'Roboto'; }
.container { margin: 150px auto; max-width: 640px; }
#carbonads {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
  Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial,
  sans-serif;
}

#carbonads {
  display: block;
  overflow: hidden;
  max-width: 728px;
  position: relative;
  font-size: 22px;
  box-sizing: content-box;
}

#carbonads > span {
  display: block;
}

#carbonads a {
  color: inherit;
  text-decoration: none;
}

#carbonads a:hover {
  color: inherit;
}

.carbon-wrap {
  display: flex;
  align-items: center;
}

.carbon-img {
  display: block;
  margin: 0;
  line-height: 1;
}

.carbon-img img {
  display: block;
  height: 90px;
  width: auto;
}

.carbon-text {
  display: block;
  padding: 0 1em;
  line-height: 1.35;
  text-align: left;
}

.carbon-poweredby {
  display: block;
  position: absolute;
  bottom: 0;
  right: 0;
  padding: 6px 10px;
  hsla(203, 11%, 95%, 0.8);
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 600;
  font-size: 8px;
  border-top-left-radius: 4px;
  line-height: 1;
  color:#aaa !important
}
.row {
  background: #f8f9fa;
  margin-top: 20px;
}

.col {
  border: solid 1px #6c757d;
  padding: 10px;
}
@media only screen and (min-width: 320px) and (max-width: 759px) {
  .carbon-text {
    font-size: 14px;
  }
}
</style>



</head>
<body>
<?php
  if (isset($_POST['states'])) {
    $for_examen=$_POST['states'];
    foreach($for_examen as $valor){
    echo $valor."<br>";
  }
  }
?>

        <form class="" action="index.php" method="post">
          <select name="states[]" id="example" class="form-control"  multiple="multiple" style="display: none;" >
                  <option value="Examen Orina">Examen Orina</option>
                  <option value="Examen Fisico - Quimico de Orina">Examen Fisico - Quimico de Orina</option>
                  <option value="Examen de Sangre">Examen de Sangre</option>
                  <option value="Examen de Sangre - Embarazo">Examen de Sangre - Embarazo</option>
                  <option value="Examen de Secreción">Examen de Secreción</option>
                  <option value="nuevo examen District Of Columbia">nuevo examen District Of Columbia</option>

            </select>
            <input type="submit" name="" value=" enviar">
        </form>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" ></script>
<script src="dist/js/BsMultiSelect.js"></script>
<script>
$("select").bsMultiSelect({cssPatch : {
                   choices: {columnCount:'3' },
                }});</script>
<script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>
</body>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>
