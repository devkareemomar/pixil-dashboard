<script setup>
import { computed, ref, toRefs } from "vue"

const props = defineProps(["item", "style"])
const { item, style } = toRefs(props)
const siteUrl = ref(import.meta.env.VITE_BACKEND_BASE_URL)

const selectedStyle = computed(() => {
	console.log(style.value)
	if (style.value?.item?.layout.toLowerCase() === "header") {
		return (selectedStyle.value = style.value.item.selectedStyles)
	}
	return "style1"
})
</script>
<template>
	<section :id="item.id" class="editable text-center" data-fields="">
		<div class="container-fluid">
			<div class="col-md-12">
				<img
					:src="`${siteUrl}/components/items/statistics/${selectedStyle}.png`"
					alt=""
				/>
			</div>
		</div>
	</section>
</template>
