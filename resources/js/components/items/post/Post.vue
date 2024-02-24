<script>
export default {
	name: "wdgt-post"
}
</script>
<script setup>
import { toRefs } from "vue"
const props = defineProps(["item"])
const { item } = toRefs(props)
</script>
<template>
	<section :id="item.id" class="editable" data-fields="title=txt&amp;body=rte">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h2>{{ item.title }}</h2>
					<div v-html="item.body" />
				</div>
			</div>
		</div>
	</section>
</template>
