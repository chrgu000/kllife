$(function() {

    $(document).on('mouseover','.tab-list a',function() {

        var $newList = $(this);

		var $parList = $(this).parents(".main");

        var curList = $parList.find("a.g").attr("data-id");

        $parList.find("a").removeClass("g");

        $newList.addClass("g");

        // 获取点击元素的title

    	var listID = $newList.attr("data-id");  

        if (listID != curList) {
			
            $parList.find("#"+curList).fadeOut(240);
            $parList.find("#"+listID).fadeIn(240);

        }

        return false;

    });

});