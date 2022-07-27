<?php

namespace Amasty\Trainee\Controllers;

use Amasty\Trainee\Core;
use Amasty\Trainee\Core\ControllerInterface;
use Amasty\Trainee\Core\ResponseInterface;
use Amasty\Trainee\HTTP\Response;

class Home implements ControllerInterface
{
    public function execute(): ResponseInterface
    {
        $response = new Response();
        $response->setStatusCode(200);
        $pizzasHtml = '';
        $sizeshtml = '';
        $sousesHtml = '';

        foreach (Core::getConnection()->fetchAll('SELECT * FROM pizza') as $data) {
            $pizzasHtml .= '<option>' . $data['name'] . '</option>';
        }

        foreach (Core::getConnection()->fetchAll('SELECT * FROM pizza_sizes') as $data) {
            $sizeshtml .= '<option>' . $data['size'] . '</option>';
        }

        foreach (Core::getConnection()->fetchAll('SELECT * FROM sous') as $data) {
            $sousesHtml .= '<option>' . $data['name'] . '</option>';
        }

        $response->setBody(sprintf(<<<BODY
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
    <body>
<form method="get" action="/index.php/submit" id="pizzas">
    <select name="pizza">
        %s
    </select>
    <select name="size">
        %s
    </select>
    <select name="sous">
        %s
    </select>
    <input type="submit" value="Заказать">
</form>
<div id="receipt" style="display: none; border: black dotted 2px; width: 400px; padding: 5px">
<p><span >Choosen pizza: </span> <span id="type"></span></p>
<p><span >Choosen size: </span><span id="sous"></span></p>
<p><span >Choosen sous: </span> <span id="size"></span></p>
<p><span >Pizza price: </span><span id="pizza_price"></span></p>
<p><span >Additional price per size: </span><span id="size_additional_price"></span></p>
<p><span >Sous price: </span><span id="sous_price"></span></p>
<p ><span >Total: </span><span id="total"/></p>
</div>
<script>
    $('#pizzas').on('submit', function (e) {
        e.preventDefault();
        
       var form = $(this);
       function renderResponse (response) {
           for (var key in response) {
               if (response.hasOwnProperty(key)) {
                    if (response[key] instanceof Object) {
                   renderResponse(response[key]);
               } else {
                   $('#' + key).text(response[key]);
               }
               }
           }
       }
       
       $.post('/index.php/submit', form.serializeArray(), function (response) {
           response = JSON.parse(response);
           
           if (response.error) {
               $('#receipt').hide();
               alert(response.error);
           } else {
               renderResponse(response);
               $('#receipt').show();
           }
       });
    });
</script>
    </body>
</html>
BODY, $pizzasHtml, $sizeshtml, $sousesHtml));

        return $response;
    }
}