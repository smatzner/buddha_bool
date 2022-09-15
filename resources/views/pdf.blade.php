<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <h1 style="text-align: center; font-family: monospace;">The Buddha Bool</h1>
    <div style="text-align: center; font-family: monospace;">            
        <p><strong>Salatbasis: </strong>{{$recipe[0]->title}}</p> 
        <p><strong>Gemüse: </strong>{{$recipe[1]->title}}</p> 
        <p><strong>Kohlenhyderate: </strong>{{$recipe[2]->title}}</p> 
        <p><strong>Proteinquelle: </strong>{{$recipe[3]->title}}</p>
        <p><strong>Fette: </strong>{{$recipe[4]->title}}</p>
        <p><strong>Früchte: </strong>{{$recipe[5]->title}}</p>
        <p><strong>Topping: </strong>{{$recipe[6]->title}}</p>
        <br><br>
        <p><strong>Energiegehalt: </strong>437kcal</p>
        <p><strong>Proteingehalt: </strong>56g</p>
        <p><strong>Fettgehalt: </strong>20g</p>
    </div>
</body>
</html>