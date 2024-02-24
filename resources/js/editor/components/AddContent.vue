<script setup>
import { ref, toRefs, inject } from "vue"
import axios from "axios"

const props = defineProps({
	items: {
		type: Array,
		default: []
	},
	layouts: {
		type: Array,
		default: []
	}
})

const page = inject("page")
const { layouts, items } = toRefs(props)
const add = ref(true)
const designer = ref(false)
const choose = ref(false)
const save = ref(false)
const color = ref("#F7FAFC")
const font = ref(null)
const spacing = ref("-0.04em")
const colors = ref([
	"#1CA085",
	"#27AF60",
	"#1FBC9C",
	"#2ECC70",
	"#3398DB",
	"#2980B9",
	"#575fcf",
	"#3D556E",
	"#222F3D",
	"#ffdd59",
	"#F2C511",
	"#F39C19",
	"#E84B3C",
	"#C0382B",
	"#BDC3C8",
	"#DDE6E8",
	"#F7FAFC",
	"#FFFFFF"
])
const siteUrl = ref(import.meta.env.VITE_BACKEND_BASE_URL)

function addLayout(event) {
	let layout = event.target.getAttribute("data-layout")

	let newItem = {}
	newItem.id = "item-" + Date.now()
	newItem.layout = layout
	newItem.title = "Lorem Ipsum"
	newItem.body =
		"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eleifend ligula ut augue scelerisque venenatis."

	if (
		layout === "Slider" ||
		layout === "HomeContact" ||
		layout === "Projects" ||
		layout === "HomeContact" ||
		layout === "Header" ||
		layout === "Footer" ||
		layout === "Statistics" ||
		layout === "Spotzone" ||
		layout === "NewsCarousel"
	) {
		newItem.styles = [{ name: "style1" }, { name: "style2" }]
		newItem.selectedStyles = "style1"
	}
	items.value.push(newItem)
	add.value = false
}

function setColor(hex) {
	color.value = hex
	let hex2 = colorContrast(hex)
	let root = document.documentElement
	root.style.setProperty("--bg-color", hex)
	root.style.setProperty("--fg-color", hex2)
	localStorage.setItem("bg-color", hex)
	localStorage.setItem("fg-color", hex2)
}

function setFont() {}

function swapStyleSheet() {}

function downloadFile() {}

function colorContrast(hex) {
	var threshold = 150 /* about half of 256. Lower threshold equals more dark text on dark background  */
	var hRed = hexToR(hex)
	var hGreen = hexToG(hex)
	var hBlue = hexToB(hex)

	function hexToR(h) {
		return parseInt(cutHex(h).substring(0, 2), 16)
	}

	function hexToG(h) {
		return parseInt(cutHex(h).substring(2, 4), 16)
	}

	function hexToB(h) {
		return parseInt(cutHex(h).substring(4, 6), 16)
	}

	function cutHex(h) {
		return h.charAt(0) == "#" ? h.substring(1, 7) : h
	}

	var cBrightness = (hRed * 299 + hGreen * 587 + hBlue * 114) / 1000
	if (cBrightness > threshold) {
		return "#000000"
	} else {
		return "#ffffff"
	}
}

function dl(filename, data) {
	var blob = new Blob([data], {
		type: "text/html"
	})
	if (window.navigator.msSaveOrOpenBlob) {
		window.navigator.msSaveBlob(blob, filename)
	} else {
		var elem = window.document.createElement("a")
		elem.href = window.URL.createObjectURL(blob)
		elem.download = filename
		document.body.appendChild(elem)
		elem.click()
		document.body.removeChild(elem)
	}
}

function handleAddClick() {
	add.value = true
	designer.value = false
	save.value = false
}

function handleSettingsClick() {
	designer.value = true
	add.value = false
	save.value = false
}

function handleSaveClick() {
	axios
		.post(
			`${import.meta.env.VITE_BACKEND_BASE_URL}/dashboard/page-builder/${
				page.value.id
			}`,
			items.value
		)
		.then(function () {
			window.location.href = `${
				import.meta.env.VITE_BACKEND_BASE_URL
			}/dashboard/site-pages`
		})
}

function getImageUrl(path) {
	return new URL(path, import.meta.url).href
}
</script>
<template>
	<transition name="slide-left">
		<div class="slidein-left" id="adder" v-if="add">
			<div class="editor-header">
				<h4 class="float-left">Add Content</h4>
				<div class="close" @click="add = false">&times;</div>
			</div>
			<div class="editor-content mt-4">
				<img
					@click="addLayout"
					v-for="layout in layouts"
					:data-layout="layout"
					class="box img-fluid"
					:src="
						getImageUrl(
							`./../../components/items/${layout.toLowerCase()}/preview.png`
						)
					"
				/>
			</div>
		</div>
	</transition>

	<transition name="slide-left">
		<div class="slidein-left" id="designer" v-if="designer">
			<div class="editor-header">
				<h4 class="float-left">Change Design</h4>
				<div class="close" @click="designer = false">&times;</div>
			</div>

			<div class="editor-content">
				<div class="label">Color</div>

				<div class="input-group mb-3">
					<input
						class="form-control"
						v-model="color"
						@change="setColor(color)"
					/>
					<div class="input-group-append">
						<button
							class="btn btn-outline-secondary w-100px"
							type="button"
							@click="choose = !choose"
						>
							<span v-if="!choose">Choose</span><span v-if="choose">Close</span>
						</button>
					</div>
				</div>

				<div v-if="choose">
					<span v-for="mycolor in colors">
						<div
							class="swatch"
							:style="'background-color: ' + mycolor"
							@click="setColor(mycolor)"
						>
							<i class="fas fa-check fa-center" v-if="color == mycolor"></i>
						</div>
					</span>
				</div>
			</div>
		</div>
	</transition>

	<transition name="slide-left">
		<div class="slidein-left" id="saver" v-if="save">
			<div class="editor-header">
				<h4 class="float-left">Save</h4>
				<div class="close" @click="save = false">&times;</div>
			</div>
		</div>
	</transition>

	<div id="dock">
		<img
			:src="`${siteUrl}/assets/img/editor/add.png`"
			class="grow"
			@click="handleAddClick"
		/>
		<img
			:src="`${siteUrl}/assets/img/editor/settings.png`"
			class="grow"
			@click="handleSettingsClick"
		/>
		<img
			:src="`${siteUrl}/assets/img/editor/save.png`"
			class="grow"
			@click="handleSaveClick"
		/>
	</div>
</template>
