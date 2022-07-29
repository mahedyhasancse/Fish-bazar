<template>
    <div>
                        <div class="form-group">
                            <label for="product_id" class=" form-control-label">Select product</label>
                            <select name="product_id" id="product_id" class=" form-control" value="{{old('parent_id')}}">
                                <option value="">Please select</option>
                                @if(!$products->isEmpty())
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}"> <img class="thumbnail" height="50" width="50" src="{{ asset($product->image[0]->image) }}">{{ $product->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('product_id')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <span id="price">Price: 123456</span>
                        </div>
    </div>
</template>
<script>
export default {
    data (){
        return {
            product: [],
        }
    },
    created(){
		axios.get('/api/products').then(response => {
			this.product = response.data
		});
    },
    methods: {

    }
}
</script>
