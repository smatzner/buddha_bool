<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <div style="text-align: center; font-family: monospace;">            
        <p><strong>Salatbasis: </strong>{{$recipeIngredients[0]->title}}</p> 
        <p><strong>Gemüse: </strong>{{$recipeIngredients[1]->title}}</p> 
        <p><strong>Kohlenhyderate: </strong>{{$recipeIngredients[2]->title}}</p> 
        <p><strong>Proteinquelle: </strong>{{$recipeIngredients[3]->title}}</p>
        <p><strong>Fette: </strong>{{$recipeIngredients[4]->title}}</p>
        <p><strong>Früchte: </strong>{{$recipeIngredients[5]->title}}</p>
        <p><strong>Topping: </strong>{{$recipeIngredients[6]->title}}</p>
        <br><br>
        <p><strong>Energiegehalt: </strong>437kcal</p>
        <p><strong>Proteingehalt: </strong>56g</p>
        <p><strong>Fettgehalt: </strong>20g</p>
    </div>
</body>
</html>