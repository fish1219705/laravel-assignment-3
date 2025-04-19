<h1>{{ $recipe->recipe_name }}</h1>
<p>{{ $recipe->instructions }}</p>
<p>Prep Time: {{ $recipe->prep_time }} minutes</p>
<p>Servings: {{ $recipe->servings }}</p>
@if($recipe->photo)
    <img src="{{ asset('storage/' . $recipe->photo) }}" width="200">
@endif
<h3>Ingredients:</h3>
<ul>
    @foreach($recipe->ingredients as $ingredient)
        <li>{{ $ingredient->ingredient_name }} - {{ $ingredient->quantity }}</li>
    @endforeach
</ul>

