<template>
	
</template>
<script>
export default{
	data(){
		return{
			products:[]
		}	
	},
	methods: {
		getProducts(){
			axios.get('/getProducts').then(response =>{
				this.products = response.data;
				console.log(response.data);	

			});
		}
	},
	created(){
		this.getProducts();
	}
}
</script>
