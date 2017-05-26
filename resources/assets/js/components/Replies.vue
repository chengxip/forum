<template>
	<div>
		<div v-for="(reply, index) in items" :key="reply.id">
			<reply :data="reply" @deleted="remove(index)"></reply>
		</div>
		<new-reply :endpoint="endpoint" @created="add"></new-reply>
	</div>
</template>
<script>
	import Reply from './Reply';
	import NewReply from './NewReply.vue'	
	export default {
		props: ['data'],
		components: { Reply,NewReply },
		data(){
			return {
				items: this.data,
				endpoint: location.pathname + '/reply'
			}
		},
		methods:{
			add(data){
				this.data.push(data);
			},
			remove(index){
				this.$emit("removed",index);
				this.items.splice(index,1)
			}
		}

	}
</script>
