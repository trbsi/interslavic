<form method="POST" action="{{route('translate')}}">
    @csrf
    <input type="text" placeholder="Text" name="text" value="{{$text}}">
    <input type="submit">
</form>

Translation:
<br>
{{$translation}}
