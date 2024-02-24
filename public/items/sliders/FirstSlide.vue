<script setup>
import { toRefs, watch, ref } from "vue"
const props = defineProps(["item", "style"])
const { item, style } = toRefs(props)

const selectedStyle = ref("style1")

watch(style, (newValue, oldValue) => {
	if (style.value.item.layout === "slider") {
		console.log(style.value.item.selectedStyles)
		selectedStyle.value = style.value.item.selectedStyles
	}
})

function getImageUrl(path) {
	return new URL(path, import.meta.url).href
}
</script>
<template>
	<section :id="item.id" class="editable text-center" data-fields="">
		<div class="container-fluid">
			<div class="col-md-12">
				<img
					:src="getImageUrl(`./${selectedStyle}.png`)"
					alt=""
					@changeStyle="handleStyleChange"
				/>
			</div>
		</div>
	</section>
</template>
