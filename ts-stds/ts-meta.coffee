mapsload = (setLat, setLng, targetField) ->
	marker = undefined
	map = undefined
	geocoder = undefined
	input = undefined
	autocomplete = undefined
	infowindow = undefined
	place = undefined
	image = undefined
	address = undefined
	latlng = undefined
	zooBoomafoo = undefined
	latlng = new google.maps.LatLng(38.959330033499675, -95.26810996977234)
	zooBoomafoo = 12
	if setLat
		latlng = new google.maps.LatLng(parseFloat(setLat), parseFloat(setLng))
		zooBoomafoo = 17
	myOptions =
		zoom: zooBoomafoo
		center: latlng
		mapTypeId: google.maps.MapTypeId.ROADMAP

	geocoder = new google.maps.Geocoder()
	map = new google.maps.Map(document.getElementById("residence_map"), myOptions)
	input = document.getElementById("residence_address")
	autocomplete = new google.maps.places.Autocomplete(input)
	autocomplete.bindTo "bounds", map
	infowindow = new google.maps.InfoWindow()
	marker = new google.maps.Marker(
		map: map
		draggable: true
	)
	google.maps.event.addListener marker, "drag", ->
		geocoder.geocode
			latLng: marker.getPosition()
		, (results, status) ->
			if status is google.maps.GeocoderStatus.OK
				if results[0]
					jQuery("#map_address").val results[0].formatted_address
					jQuery(targetField).val marker.getPosition().lat() + "," + marker.getPosition().lng()

		infowindow.close()
		infowindow.setContent null

	if setLat
		marker.setPosition new google.maps.LatLng(parseFloat(setLat), parseFloat(setLng))
		marker.setMap map
	google.maps.event.addListener autocomplete, "place_changed", ->
		marker = null
		marker = new google.maps.Marker(
			map: map
			draggable: true
		)
		google.maps.event.addListener marker, "drag", ->
			geocoder.geocode
				latLng: marker.getPosition()
			, (results, status) ->
				if status is google.maps.GeocoderStatus.OK
					if results[0]
						jQuery("#map_address").val results[0].formatted_address
						jQuery(targetField).val marker.getPosition().lat() + "," + marker.getPosition().lng()

			infowindow.close()
			infowindow.setContent null

		infowindow.close()
		input.className = ""
		place = autocomplete.getPlace()
		unless place.geometry
			input.className = "notfound"
			return
		if place.geometry.viewport
			map.fitBounds place.geometry.viewport
		else
			map.setCenter place.geometry.location
			map.setZoom 17 # Why 17? Because it looks good.
		address = ""
		jQuery(targetField).val (place.geometry.location).toString().slice(1, -1)
		address = [(place.address_components[0] and place.address_components[0].short_name or ""), (place.address_components[1] and place.address_components[1].short_name or ""), (place.address_components[2] and place.address_components[2].short_name or "")].join(" ")	if place.address_components
		marker.setPosition place.geometry.location
		infowindow.setContent "<div><strong>" + place.name + "</strong><br>" + address
		geocoder.geocode
			latLng: marker.getPosition()
		, (results, status) ->
			if status is google.maps.GeocoderStatus.OK
				if results[0]
					jQuery("#map_address").val results[0].formatted_address
					jQuery(targetField).val marker.getPosition().lat() + "," + marker.getPosition().lng()

		google.maps.event.addListener marker, "click", ->
			infowindow.open map, marker

		marker.setMap map

jQuery(document).ready ($) ->
	$(".custom_media_upload").click ->
		clickedButton = $(this)
		send_attachment_bkp = wp.media.editor.send.attachment
		wp.media.editor.send.attachment = (props, attachment) ->
			$(clickedButton).siblings(".custom_media_image").attr "src", attachment.url
			$(clickedButton).siblings(".custom_media_url").val attachment.url
			wp.media.editor.send.attachment = send_attachment_bkp

		wp.media.editor.open()
		false


jQuery (jQuery) ->
	jQuery("#media-items").bind "DOMNodeInserted", ->
		jQuery("input[value=\"Insert into Post\"]").each ->
			jQuery(this).attr "value", "Use This Image"


	jQuery(".custom_upload_image_button").click ->
		formfield = jQuery(this).siblings(".custom_upload_image")
		preview = jQuery(this).siblings(".custom_preview_image")
		tb_show "", "media-upload.php?type=image&TB_iframe=true"
		window.send_to_editor = (html) ->
			imgurl = jQuery("img", html).attr("src")
			classes = jQuery("img", html).attr("class")
			id = classes.replace(/(.*?)wp-image-/, "")
			formfield.val id
			preview.attr "src", imgurl
			tb_remove()

		false

	jQuery(".custom_clear_image_button").click ->
		defaultImage = jQuery(this).parent().siblings(".custom_default_image").text()
		jQuery(this).parent().siblings(".custom_upload_image").val ""
		jQuery(this).parent().siblings(".custom_preview_image").attr "src", defaultImage
		false

	jQuery(".repeatable-add").click ->
		field = jQuery(this).closest("td").find(".custom_repeatable li:last").clone(true)
		fieldLocation = jQuery(this).closest("td").find(".custom_repeatable li:last")
		jQuery("textarea", field).val("").attr "name", (index, name) ->
			name.replace /(\d+)/, (fullMatch, n) ->
				Number(n) + 1


		field.insertAfter fieldLocation, jQuery(this).closest("td")
		false

	jQuery(".repeatable-remove").click ->
		jQuery(this).parent().remove()
		false

	jQuery(".custom_repeatable").sortable
		opacity: 0.6
		revert: true
		cursor: "move"
		handle: ".sort"

	jQuery(".repeatable-adds").click ->
		field = jQuery(this).closest("td").find(".custom_repeatables li:last").clone(true)
		fieldLocation = jQuery(this).closest("td").find(".custom_repeatables li:last")
		jQuery("input", field).val("").attr "name", (index, name) ->
			name.replace /(\d+)/, (fullMatch, n) ->
				Number(n) + 1


		field.insertAfter fieldLocation, jQuery(this).closest("td")
		false

	jQuery(".repeatable-removes").click ->
		jQuery(this).parent().remove()
		false

	jQuery(".custom_repeatables").sortable
		opacity: 0.6
		revert: true
		cursor: "move"
		handle: ".sort"

	jQuery(".list-icons").siblings(".preview-icons").click ->
		list = jQuery(this).siblings ".list-icons"
		jQuery(list).toggleClass 'active'
		jQuery(list).children("li").click ->
			hiddenInput = jQuery(list).siblings ".hidden-icons"
			iconPreview = jQuery(list).siblings(".preview-icons")
			listValue = jQuery(this).attr("data-value")
			jQuery(hiddenInput).attr "value", listValue
			jQuery(this).attr "data-selected", "selected"
			previewData = '<i class="icon-'+listValue+'"></i>&nbsp;'+listValue+'&nbsp;<i class="icon-angle-down"></i>'
			jQuery(iconPreview).html(previewData)
			jQuery(this).siblings().removeClass "active"
			jQuery(list).removeClass 'active'


