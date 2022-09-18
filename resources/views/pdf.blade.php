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
        <h3>Für {{$portions}} Portion:</h3>         
        <p><strong>Salatbasis: </strong><span class="amount">{{$amount*0.1}}g</span> {{$ingredients[0]->title}}</p>
        <p><strong>Gemüse: </strong><span class="amount">{{$amount*0.2}}g</span> {{$ingredients[1]->title}}</p> 
        <p><strong>Kohlenhyderate: </strong><span class="amount">{{$amount*0.2}}g</span> {{$ingredients[2]->title}}</p> 
        <p><strong>Proteinquelle: </strong><span class="amount">{{$amount*0.2}}g</span> {{$ingredients[3]->title}}</p>
        <p><strong>Fette: </strong><span class="amount">{{$amount*0.15}}g</span> {{$ingredients[4]->title}}</p>
        <p><strong>Früchte: </strong><span class="amount">{{$amount*0.1}}g</span> {{$ingredients[5]->title}}</p>
        <p><strong>Topping: </strong><span class="amount">{{$amount*0.05}}g</span> {{$ingredients[6]->title}}</p>
        <br><br>
        <p><strong>Energiegehalt: </strong>{{$energy}}kcal</p>
        <p><strong>Proteingehalt: </strong>{{$protein}}g</p>
        <p><strong>Kohlenhydratgehalt: </strong>{{$carbohydrate}}g</p>
        <p><strong>Fettgehalt: </strong>{{$fat}}g</p>
    </div>
</body>
</html>