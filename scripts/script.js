$(document).ready(function(){
	// Upvote functionality on each individual comment
    $(".btn-upvote").click(function(){
		$(this).addClass('active');
        var postID = $(this).val();
            $post = $(this);

            $.ajax({
				url: './includes/upvotes.php',
				type: 'get',
				data: {
					'liked': 1,
					'postid': postID
				},
				success: function(response){
					$post.find("span").html(response);
				}
			});
    });

	

	// Filter functionality in index.js
	$('.filter-menu__selection').click(function() {
		// Get data from selected option and update the url
		let filter_param = $(this).data('filter');
		let filter_order = $(this).data('order');
		let url = new URL(window.location.href);
		let search_params = url.searchParams;
		search_params.set('filter', filter_param);
		search_params.set('order', filter_order);
		url.search = search_params.toString();
		let new_url = url.toString();
		window.location.href = new_url;

		// Update the 'selected' option in the filter bar
		let selectedHtml = $(this).html();
		$('.filter-menu__current-selection').html(selectedHtml);

		// Add selected class to selected element and remove previous selected element, persisting on local storage
		$(this).addClass('selected-filter');
		localStorage.setItem('selected-filter', $(this).attr('id'));
	})

	// Check local storafe for individual filter item
	if(localStorage.getItem('selected-filter')) {
		const selectedItem = localStorage.getItem('selected-filter');
		$(`#${selectedItem}`).addClass('selected-filter');
	} else {
		localStorage.setItem('selected-filter', 'most_upvotes');
		$('#most_upvotes').addClass('selected-filter');
	}
	

	// Check local storage for filter menu status
	if(localStorage.getItem("filter-menu") && localStorage.getItem("filter-menu") === "active") {
		$('.filter-menu__icon').addClass('active');
		$('.filter-menu__selections').addClass('active');
	}

	// Filter icon toggle
	$('.filter-menu__current-selection-box').click(function() {
		if(localStorage.getItem("filter-menu") === "active") {
			localStorage.removeItem("filter-menu")
		} else {
			localStorage.setItem("filter-menu", "active")
		}

		$('.filter-menu__icon').toggleClass('active');
		$('.filter-menu__selections').toggleClass('active');
	})

	// Mobile navigation functionality
	$('.mobile-nav').click(function() {
		$('header').toggleClass('active');
		$('.categories-box').toggleClass('active');
		$('.roadmap-box').toggleClass('active');
		$(this).toggleClass('active');
	})

	// Dynamically populate number of suggestions in index.js
	$('.total-suggestions').html(`${$('.post-items li').length} suggestions`);
	
	// Character count functionality
	$('.post__add-comment-text').on('keyup', function() {
		let remainingChars = 250 - $(this).val().length;
		$('.post__character-count').html(remainingChars);
	})

	// Toggle reply text fields
	$('.comment__reply').click(function() {
		$(this).next().toggleClass('active');
	})

	// Tab cotrol for roadmap on mobile
	$('[role="tab"]').click(function(e) {
		$('[aria-selected="true"]').attr("aria-selected", "false");
		$(e.target).attr("aria-selected", "true");
		$('.roadmap__list').removeClass('active');
		const roadmapItem = $(e.target).attr("aria-controls");
		$(`#${roadmapItem}`).addClass('active');
	})

	let tabFocus = 0;
	const tabList = $('[role="tab"]');
	$('[role="tab"]').keydown(function(e) {
		const keyRight = 39;
		const keyLeft = 37;
		if(e.keyCode === keyRight || e.keyCode === keyLeft) {
			$(e.target).attr("tabindex", -1);
		}
		if(e.keyCode === keyRight) {
			tabFocus++;
			if(tabFocus >= tabList.length) {
				tabFocus = 0;
			}
		}
		if(e.keyCode === keyLeft) {
			tabFocus--;
			if(tabFocus < 0) {
				tabFocus = tabList.length - 1;
			}
		}
		$(tabList[tabFocus]).attr("tabindex", 0);
		$(tabList[tabFocus]).focus();
		$('[aria-selected="true"]').attr("aria-selected", "false");
		$(tabList[tabFocus]).attr("aria-selected", "true");
	})


	// Custom select box
	$('.post-control__input-select').click(function() {
		$(this).find('.custom-select').toggleClass('active');
	});

	$('.custom-select__option--category').each(function() {
		$(this).click(function() {
			$('#category').attr('value', $(this).html());
			$('.custom-select__option--category.selected').removeClass('selected');
			$(this).addClass('selected');
		})
	})

	$('.custom-select__option--status').each(function() {
		$(this).click(function() {
			$('#status').attr('value', $(this).html());
			$('.custom-select__option--status.selected').removeClass('selected');
			$(this).addClass('selected');
		})
	})

});



