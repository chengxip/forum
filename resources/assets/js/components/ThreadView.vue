<script>
import Replies from './Replies.vue'
export default {
	props:['initialcount'],
	components: {Replies},
	data(){
		return {
			repliesCount:this.initialcount
		}
	}
}
</script>
