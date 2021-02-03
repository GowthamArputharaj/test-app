<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body class="text-center">
    <img class="mb-4 mt-5" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <div class="row">
        <div class="col-6">
            <select name="def_from" id="def_from">
                <option value="0">From</option>
                @foreach($locals as $key => $local)
                    <option value="{{$key}}" @if($key==session('def_from')) selected @endif>{{$local}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <select name="def_to" id="def_to">
                <option value="0">To</option>
                @foreach($locals as $key => $local)
                    <option value="{{$key}}" @if($key==session('def_to')) selected @endif>{{$local}}</option>
                @endforeach
            </select></div>
      </div>
    <form action="/translateText" class="form-signin w-75" style="margin:0 auto; padding:15px;">
      <div class="row">
        <div class="col-6">
            <select name="from" id="from">
                <option value="0">From</option>
                @foreach($locals as $key => $local)
                    <option value="{{$key}}" @if($key==session('def_from')) selected @endif>{{$local}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <select name="to" id="to">
                <option value="0">To</option>
                @foreach($locals as $key => $local)
                    <option value="{{$key}}" @if($key==session('def_to')) selected @endif>{{$local}}</option>
                @endforeach
            </select></div>
      </div>
      <h1 class="h3 mb-3 font-weight-normal">Translate from any language to any language</h1>
      <label for="inputEmail" class="sr-only">Translation Text</label>
      <textarea class="" name="translate_text" id="translate_text" cols="50" rows="10" placeholder="Translation Text">{{$old_translate_text ?? ''}}</textarea>
      <!-- <input type="text" id="inputEmail" name="translate_text" class="form-control" placeholder="Translation Text" required="" autofocus=""> -->
      <label for="inputPassword" class="sr-only">Translated</label>
      <textarea class="" id="" cols="50" rows="10" placeholder="Translated Text">{{ $translated ?? '' }}</textarea>
      <!-- <input type="text" id="inputPassword" value="{{ $translated ?? '' }}" class="form-control" placeholder="Translated" > -->
      <button class="btn btn-lg btn-primary btn-block" type="submit">Translate</button>
      <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
</body>
<script type="text/javascript">
document.getElementById("translate").addEventListener('click', function(ev) {
    console.log('translate clicked');
    $.ajax({
    	url: "www.site.com/page",
    	success: function(data){ 
    	    $('#data').text(data);
    	},
    	error: function(){
    		alert("There was an error.");
    	}
    });
});
</script>
</html>