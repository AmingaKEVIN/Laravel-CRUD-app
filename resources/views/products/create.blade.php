@extends('layout.app')
@section('content')
<main class="container">
    <section>
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="titlebar">
            <h1>Add Product</h1>
            <button>Save</button>
        </div>
        @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error )
                     <li>{{$error}}</li>
                @endforeach

            </ul>
        </div>

        @endif
        <div class="card">
           <div>
                <label>Name</label>
                <input type="text" name="name">
                <label>Description (optional)</label>
                <textarea cols="10" rows="5" name="description"></textarea>
                <label>Add Image</label>
                <img src="" alt="" class="img-product" accept="/image" onchange="showFile(event)" />
                <input type="file" name="image">
            </div>
           <div>
                <label>Category</label>
                
                <hr>
                <label>Inventory</label>
                <input type="text" class="input" name="quantity" >
                <hr>
                <label>Price</label>
                <input type="text" class="input" name="price" >
           </div>
        </div>
        <div class="titlebar">
            <h1></h1>
            <button>Save</button>
        </div>
    </form>
    </section>
</main>
<script>
    function showFile(event){
        var input= event.target;
        var reader = new FileReader();
        reader.onload= function(){
            var dataurl=reader.result;
            var output = document.getElementById('file-preview')
            output.src = dataurl

        }
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection