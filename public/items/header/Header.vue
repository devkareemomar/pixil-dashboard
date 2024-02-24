<script>
export default {
	name: "wdgt-header"
}
</script>
<script setup>
import { toRefs } from "vue"
const props = defineProps(["item"])
const { item } = toRefs(props)
</script>
<template>
	<section
		:id="item.id"
		class="editable text-center"
		data-fields="icon=icon&amp;title=txt&amp;subtitle=txt&amp;button_text=txt&amp;button_link=txt"
	>
		<div class="container">
			<i :class="item.icon + ' fa-big'"></i>

			<h1>{{ item.title }}</h1>
			<p>{{ item.subtitle }}</p>

			<a
				:href="item.button_link"
				class="btn btn-secondary"
				v-if="item.button_text"
				>{{ item.button_text }}</a
			>
		</div>
	</section>
</template>
