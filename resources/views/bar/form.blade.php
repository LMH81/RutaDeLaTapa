<form action="{{ url('bars') }}" method="POST" enctype="multipart/form-data">

    <h1>{{$modo}} Bar</h1>
    
    @if (count($errors)>0)
        <div class="alert alert-danger" role="alert">
    
            <ul>
                @foreach($errors->all() as $error)
                     <li>{{$error}}</li>
                @endforeach
            </ul> 
        </div>      
         
    
    @endif
    
    <div class="form-group">
    
        <div class="mb-3">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" value="{{ isset ($bar->name) ? $bar->name :old('name')}}" id="name">        
        </div>
    </div>
    
    <div class="form-group">
        <div class="mb-3">
            <label for="description">Descripción </label>
            <input type="text" class="form-control" name="description" value="{{ isset($bar->description) ? $bar->description :old('description') }}" id="description">        
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3">
            <label for="address">Dirección </label>
            <input type="text" class="form-control" name="address" value="{{ isset($bar->address) ? $bar->address :old('address') }}" id="address">        
        </div>
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono : </label> 
            <input type="text" class="form-control" name="phone" value="{{ isset($bar->phone) ? $bar->phone : old('phone') }}" id="phone" >       
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3">
            <label for="opening_hours" class="form-label">Horario : </label> 
            <input type="text" class="form-control" name="opening_hours" value="{{ isset($bar->opening_hours) ? $bar->opening_hours : old('opening_hours') }}" id="opening_hours" >       
        </div>
    </div>
            
    <input class="btn btn-success" type="submit"  value="{{$modo}} bar" >    
    
    
    <a href="{{ url('bars/')}}" class="btn btn-primary">Regresar</a>
    </form>