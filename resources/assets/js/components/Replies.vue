<template>
	<div>
		<div v-for="(reply, index) in items" :key="reply.id">
			<reply :data="reply" @deleted="remove(index)"></reply>
		</div>
		<paginator :dataSet="dataSet" @updated="load"></paginator>
		<new-reply :endpoint="endpoint" @created="add"></new-reply>
	</div>
</template>
<script>
	import Reply from './Reply';
	import NewReply from './NewReply.vue'	
	import Paginator from './Paginator.vue'	
	export default {
		components: { Reply,NewReply,Paginator },
		data(){
			return {
				items: [],
				dataSet: [],
				endpoint: location.pathname + '/reply'
			}
		},
		methods:{
			add(data){
				this.items.push(data);
			},
			remove(index){
				this.$emit("removed",index);
				this.items.splice(index,1)
			},
			load(page){
				axios.get(this.url(page)).then(
					this.refresh
				)
			},
			url(page){
				if(!page){
					let m = location.search.match(/page=(\d+)/)
					page = m?m[1]:1;
				}
				return location.pathname + '/reply?page='+page;
			},
			refresh({data}){
				this.items = data.data
				this.dataSet = data
			}
		},
		created(){
			this.load();
		}

	}
</script>
