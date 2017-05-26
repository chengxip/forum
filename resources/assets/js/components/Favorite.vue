<template>
	<div>
		<button type="submit"  :class="classes" @click="toggle">
			<span class="glyphicon glyphicon-heart"></span>
			<span v-text="favorites"></span>

		</button>
	</div>
</template>
<script>
	export default {

		props:['reply'],

		computed:{
			classes(){
				return [ 'btn','btn-xs',
					this.active ? 'btn-primary' :'btn-default'
				]
			},
			endpoint(){
				return '/reply/'+this.reply.id +'/favorite';
			}
		},
		data(){
			return {
				active : this.reply.isFavorited,
				favorites : this.reply.favoriteCount
			}
		},
		methods:{
			toggle(){
				!this.active?this.doFavorite():this.unFavorite();
			},
			doFavorite(){
				axios.post(this.endpoint)
				this.active = true;
				this.favorites ++;
			},
			unFavorite(){
				axios.delete(this.endpoint)
				this.active = false;
				this.favorites --;
			}
		}
	}
</script>

