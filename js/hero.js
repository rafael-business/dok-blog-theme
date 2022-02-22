(function() {

	const hero = document.getElementsByClassName( 'entry-hero' )[0];
    const sub_hero = document.getElementsByClassName( 'sub-hero' )[0];

    hero.style.cursor = 'pointer';
    sub_hero.style.cursor = 'default';

	if ( ! hero ) {
		return;
	}

	const controls = [...hero.getElementsByClassName( 'controls' )];

    controls.forEach( control => {
       
        control.addEventListener( 'click', function(){

            controls.forEach( c => c.classList.remove( 'active' ));
            control.classList.toggle( 'active' );

            var thumb = control.dataset.thumb;
            var link = control.dataset.link;
            hero.style = 'background-image: url('+thumb+'); cursor: pointer;';
            hero.dataset.link = link;
        });

        control.addEventListener( 'mouseover', function(){

            count_old = count;
            count = 4;
        });

        control.addEventListener( 'mouseout', function(){

            count = count_old;
        });
    });

    hero.addEventListener( 'click', function(e){

        if ( e.target.classList.contains('entry-hero') ) {
            window.location.href = hero.dataset.link;
        }
    });

    var count = 0;
    setInterval(() => {
        
        if ( 4 === count ) return;

        controls[count].click();
        count++;

        count = 3 === count ? 0 : count;
    }, 4000);

    const mais_lidas = document.getElementsByClassName('mais-lidas')[0];
    const carousel = mais_lidas.getElementsByClassName('carousel')[0];
    const arrows = [...mais_lidas.getElementsByClassName('arrow')];

    var left = 0;
    var max = ( carousel.getElementsByTagName('a').length - 1 ) * 846;

    arrows.forEach( arrow => {
       
        arrow.addEventListener( 'click', function(e){

            left = e.target.classList.contains('arrow-right') ? left + 846 : left - 846;
            
            if ( 0 > left ) {
                left = 0;
            } else if ( left > max ) {
                left = left - 846;
            }

            carousel.scroll({
                top: 0,
                left: left,
                behavior: 'smooth'
            });
        });
    });

}());