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
        <h5>Für 1 Portion:</h5>         
        <p><strong>Salatbasis: </strong>{{$ingredients[0]->title}}</p> 
        <p><strong>Gemüse: </strong>{{$ingredients[1]->title}}</p> 
        <p><strong>Kohlenhyderate: </strong>{{$ingredients[2]->title}}</p> 
        <p><strong>Proteinquelle: </strong>{{$ingredients[3]->title}}</p>
        <p><strong>Fette: </strong>{{$ingredients[4]->title}}</p>
        <p><strong>Früchte: </strong>{{$ingredients[5]->title}}</p>
        <p><strong>Topping: </strong>{{$ingredients[6]->title}}</p>
        <br><br>
        <p><strong>Energiegehalt: </strong>{{$energy}}kcal</p>
        <p><strong>Proteingehalt: </strong>{{$protein}}g</p>
        <p><strong>Kohlenhydratgehalt: </strong>{{$carbohydrate}}g</p>
        <p><strong>Fettgehalt: </strong>{{$fat}}g</p>
    </div>
</body>
</html>