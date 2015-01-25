$(window).load(function()
{
	$(".diaporama").each(function()
	{
		initDiapo($(this));
	});
});

initDiapo = function(_el)
{
	var _diaporama = _el,
		_diapo_container = _diaporama.find(".diaporama-container"),
		_diapos = _diapo_container.find(".diapo"),
		_nav = _diaporama.find(".nav-diapo"),
		_thumb_container = _nav.find(".container"),
		_thumbs = _nav.find(".thumb"),
		_arrow = _nav.find(".arrow"),
		_total = _thumbs.length,
		_current_diapo = 0,
		_d_init = null,
		_d_move_thumbs = null,
		_num_thumb_visible = 0,
		_current_thumb = 0,
		_timer = null;


	_d_init = function()
	{
		_thumbs.on("click", function(e)
		{
			e.preventDefault();
			_current_diapo = $(this).index();
			_diapos.fadeOut(300);
			_diapos.eq(_current_diapo).stop(true, true).fadeIn(300);
		});

		_d_init_thumbs_nav();

		_diapos.eq(0).fadeIn();
	};


	_d_init_thumbs_nav = function()
	{
		_num_thumb_visible = Math.floor(_nav.width() / _thumbs.outerWidth(true));
		_current_thumb = 0;
		_thumb_container.css({'width' : (_thumbs.outerWidth(true) * _total) - 5 + "px"});

		if(_total <= _num_thumb_visible)
		{
			_arrow.hide();
			_thumb_container.css({
				"left" : (_nav.width() - _thumb_container.width()) / 2 + "px"
			});
		}

		_arrow.on("click", function(e)
		{
			e.preventDefault();

			if($(this).hasClass("left"))
			{
				_current_thumb = _current_thumb - _num_thumb_visible;
			} else if($(this).hasClass("right")){
				_current_thumb = _current_thumb + _num_thumb_visible;
			}

			_d_move_thumbs();
		});
	};


	_d_move_thumbs = function()
	{
		var _coords = null;

		if( ((_current_thumb + _num_thumb_visible) * _thumbs.outerWidth(true))  >= _thumb_container.width())
		{
			_current_thumb = _total - _num_thumb_visible;
			_coords = _thumb_container.width() - _nav.width();
		} else if(_current_thumb < 0) {
			_coords = 0;
			_current_thumb = 0;
		} else {
			_coords = _current_thumb * _thumbs.outerWidth(true);
		}

		_thumb_container.stop(true, true).animate({ left : -_coords}, 300, "easeOutExpo");
	};

	_d_init();
};