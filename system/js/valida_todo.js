
function sololetras(e){
  key=e.keyCode || e.which;
  teclado=String.fromCharCode(key).toLowerCase();//para solo numeros quitar .toLowerCase()
  numero=" abcdefghiyjklmnñopqrstuvwxyz._-,óíáéú";
  especial="8-37-38-46-164-13-9-16";
  tecla_especial=false;

  for(var i in especial){
    if(key==especial[i]){
      tecla_especial=true;break;
    }
  }
  if(numero.indexOf(teclado)==-1 && !tecla_especial){
    return false;
  }
 }

 function solonumeros(e){
   key=e.keyCode || e.which;
   teclado=String.fromCharCode(key);//para solo numeros quitar .toLowerCase()
   numero="0123456789.";
   especial="8-37-38-46-164-13-9-16";
   tecla_especial=false;

   for(var i in especial){
     if(key==especial[i]){
       tecla_especial=true;break;
     }
   }
   if(numero.indexOf(teclado)==-1 && !tecla_especial){
     return false;
   }
  }

function solonumeroRUC(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);//para solo numeros quitar .toLowerCase()
    numero="0123456789";
    especial="8-37-38-46-164-13-9-16";
    tecla_especial=false;

    for(var i in especial){
      if(key==especial[i]){
        tecla_especial=true;break;
      }
    }
    if(numero.indexOf(teclado)==-1 && !tecla_especial){
      return false;
    }
   }


  function enable(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);//para solo numeros quitar .toLowerCase()
    numero="";
    especial="9";
    tecla_especial=false;

    for(var i in especial){
      if(key==especial[i]){
        tecla_especial=true;break;
      }
    }
    if(numero.indexOf(teclado)==-1 && !tecla_especial){
      return false;
    }
   }



//  MAYUSCULA PRIMERA LETRA DE CADA PALABRA

   function toTitleCase(str) {
     return str.replace(/(?:^|\s)\w/g, function(match) {
         return match.toUpperCase();
     });
 }
//  MAYUSCULA PRIMERA LETRA DE TODOO EL TEXTO
   function MaysPrimera(string){
     return string.charAt(0).toUpperCase() + string.slice(1);
   }
// VALIDACION DE MAYUSCULAS EN CAJA DESCRIPCION
   // $(document).on('keyup','#descrip', function(){
   //   var valr= $('#descrip').val();
   //   if(valr!=""){
   //    texto = MaysPrimera(valr.toLowerCase());  //  MAYUSCULA PRIMERA LETRA DE TODOO EL TEXTO
   //    // texto =toTitleCase(valr);  //  MAYUSCULA PRIMERA LETRA DE CADA PALABRA
   //     //texto = valr.toUpperCase();// TODO0 MAYUSCULA
   //     //texto = valr.toLowerCase();// TODO0 MINUSCULA
   //     document.getElementById('descrip').value=texto;
   //   }
   // });
