@extends('layout.app')
@section('content')
@if ($message= Session::get('success'))
       <script type="text/javascript">
         Swal.fire("product has been edited  successfully!");
       </script>
            
        @endif
<main class="container">
    <section>
        <form action="{{route('products.update', $products->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="titlebar">
            <h1>Edit Product</h1>
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
                <input type="text" name="name" value="{{$products->name}}">
                <label>Description (optional)</label>
                <textarea cols="10" rows="5" name="description" value="{{$products->description}}">{{$products->description}}</textarea>
                <label>Add Image</label>
                <input type="hidden" name="hidden_product_image" value="{{$products->image}}">
                <img src="{{asset('images/'.$products->image)}}" alt="" class="img-product" accept="/image" onchange="showFile(event)" />
                <input type="file" name="image">
            </div>
           <div>
                <label>Category</label>
                <select  name="category" id="" value="">
                 
             
           
       
                   
                </select>
                <hr>
                <label>Inventory</label>
                <input type="text" class="input" name="quantity" value="{{$products->quantity}}" >
                <hr>
                <label>Price</label>
                <input type="text" class="input" name="price"  value="{{$products->price}}">

                <input type="hidden" name="hidden_id" value="{{$products->id}}">
           </div>
        </div>
        <div class="titlebar">
            <h1></h1>
            <button>Save</button>
            <h1></h1>
            
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