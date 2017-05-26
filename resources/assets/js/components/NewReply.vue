<template>
	<div>
		<div v-if="signedIn">
		<div class="form-group">
			<textarea name="body" placeholder="Have something to say" class="form-control" rows="5" v-model="body" ></textarea>
		</div>
		<button type="submit" class="btn btn-primary" @click="save()">Submit</button>
	</div>
	<p class="text-center" v-else> Please <a href="/auth/login"> Sign in </a> to participate in this discussions.</p>
</div>

</template>
<script>
	export default {

		props:['endpoint'],

		computed:{
			signedIn(){
				return window.app.signedIn;
			}
		},

		data(){
			return {
				body:''
			}
		},
		methods:{
			save(){
				axios.post(this.endpoint,{body:this.body}).then(
					({data}) => {
						this.body = '';
						this.$emit('created',data);
						flash('Your reply has been posted')
					}
				)
			}
		}
	}
</script>

