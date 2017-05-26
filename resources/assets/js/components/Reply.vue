<template>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="level">
				<h5 class="flex">
					<a :href="'/profile/'+ data.owner.name" v-text="data.owner.name"></a>
					Said {{ data.created_at }} ...
				</h5>
				<favorite :reply="data" v-if="signedIn"></favorite>
			</div>
		</div>
		<div class="panel-body">
			<div v-if="editing">
				<div class="form-group">
					<textarea class="form-control" v-model="body"></textarea>
				</div>
				<button class="btn btn-primary btn-xs mr-1" @click="update">Update</button>
				<button class="btn btn-default btn-xs" @click="editing=false">Cancel</button>
			</div>
			<div v-else v-text="body"> </div>

		</div>
		<div class="panel-footer" v-if="canUpdate">
			<div class="level">
				<button class="btn btn-default btn-xs mr-1" @click="editing=true">Edit</button>
				<button class="btn btn-danger btn-xs" @click="destroy">DELETE</button>
			</div>
		</div>
	</div>

</template>
<script>
import Favorite from './Favorite.vue'
export default {
	components: {Favorite},
	props: ['data'],
	data(){
		return {
			editing: false,
			body:this.data.body
		}
	},
	computed:{
		signedIn(){
			return window.app.signedIn;
		},
		canUpdate(){
			return this.authorize( user => this.data.user_id == user.id)
		}
	},
	methods:{
		destroy(){
			axios.delete('/reply/'+this.data.id).then(
				()=>{
					this.$emit('deleted',this.data.id);
					flash('Commment deleted');
				}
				)
		},
		update(){
			axios.patch('/reply/'+this.data.id,
				{
					body:this.body}
			).then(
				()=>{
					this.editing=false
					flash('comment updated')
				})

		}
	}
}
</script>
