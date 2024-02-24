<script setup>
import { toRefs, watch, ref } from "vue"
const props = defineProps(["item", "style"])
const { item, style } = toRefs(props)

const selectedStyle = ref("style1")
const siteUrl = ref(import.meta.env.VITE_BACKEND_BASE_URL)

watch(style, (newValue, oldValue) => {
	if (style.value.item.layout?.toLowerCase() === "homeContact") {
		selectedStyle.value = style.value.item.selectedStyles
	}
})
</script>
<template>
	<section :id="item.id" class="editable text-center" data-fields="">
		<div class="container-fluid">
			<div class="col-md-12">
				<img
					:src="`${siteUrl}/components/items/homecontact/${selectedStyle}.png`"
					alt=""
					@changeStyle="handleStyleChange"
				/>
			</div>
		</div>
	</section>
</template>
