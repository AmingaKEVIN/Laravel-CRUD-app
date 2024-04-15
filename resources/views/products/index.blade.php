@extends('layout.app');
@section('content')

<main class="container">
    <section>
        <div class="titlebar">
            <h1>Products</h1>
         <a href="{{route('products.create')}}"><button>Add Products</button></a>
        </div>
        @if ($message= Session::get('success'))
       <script type="text/javascript">
         Swal.fire("product added successfully!");
       </script>
            
        @endif
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="{{route('products.index')}}" method="get" accept-charset="UTF-8" role="search" name ="search" value="{{request('search')}}">
            <div class="table-search">
                   
                <div>
                   <input type="submit" value="Submit"> 
                    </button>
                    <span class="search-select-arrow">
                        <i class="fas fa-caret-down"></i>
                    </span>
                </div>
                <div class="relative">
                    <input class="search-input" type="text" name="search" placeholder="Search product..." value="{{ request('search') }}">
                </div>
            </div>
        </form>
            <div class="table-product-head">
                <p>Image</p>
                <p>Name</p>
                <p>Category</p>
                <p>Inventory</p>
                <p>Actions</p>
            </div>
            <div class="table-product-body">
                
                @if($products !== null && count($products) > 0)

                @foreach($products as $product)
                <img src="{{asset('images/'. $product->image)}}"/>
                <p> {{$product->name}}</p>
                <p>{{$product->category}}</p>
                <p>{{$product->quantity}}</p>
                <div>     
                    <a href="{{route('products.edit',  ['product' => $product->id])}}"><button class="btn btn-success" >
                        <i class="fas fa-pencil-alt" ></i> 
                    </button>
                </a>
                <form action="{{route('products.destroy', $product->id)}}" method="post", >
                 @method('delete')
                 @csrf
                 <button class="btn btn-danger" >
                    <i class="far fa-trash-alt"></i>
                </button>
            
                 
                
                
                
                </form>

                   
                </div>
          
                    
                @endforeach

                @else

                <p>Product Not Found</p>

                @endif
            </div>
                
          
        </div>
    </section>
   
   
    <br>
</main> 
@endsection