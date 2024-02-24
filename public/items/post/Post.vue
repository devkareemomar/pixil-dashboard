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
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<h2>{{ item.title }}</h2>
					<p>{{ item.body }}</p>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</section>
</template>
