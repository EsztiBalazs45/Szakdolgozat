<template>
  <div id="panels">
    <header class="navbar main-tool-bar" ref="navbar">
      <nav class="flex flex-1 justify-between items-center" id="nav-menu">
        <div class="flex space-x-3">
          <a v-for="(panel, index) in panelNames" :key="index" href="#" @click.prevent="scrollToPanel(index)"
            class="anchor">
            {{ panel }}
          </a>
        </div>
        <div class="flex space-x-3">
          <a :href="route('register')"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Registration</a>
          <a :href="route('login')"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Log
            in</a>
        </div>
      </nav>
    </header>
    <div id="panels-container" ref="panelsContainer">
      <div v-for="(panel, index) in panels" :key="index" class="panel">
        <template v-if="index === 3">
          <div class="gallery">
            <ul class="cards">
              <li v-for="card in galleryCards" :key="card">{{ card }}</li>
            </ul>
            <div class="arrows">
              <button class="arrow left" @click="prevCard">
                ◀
              </button>
              <button class="arrow right" @click="nextCard">
                ▶
              </button>
            </div>
          </div>
        </template>
        <template v-else>
          Panel {{ index + 1 }}
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

export default {
  setup() {
    const panelsContainer = ref(null);
    const navbar = ref(null);
    const panels = ref(Array(5).fill(null));
    const galleryCards = ref(["", "1", "2", "3"]);
    const currentCard = ref(0);
    const panelNames = ref(["Kezdőlap", "Rólunk", "Dokumentumok", "Szolgáltatások", "Elérhetőségek"]);
    let tween;

    onMounted(() => {
      const panelElems = gsap.utils.toArray(".panel");
      tween = gsap.to(panelElems, {
        xPercent: -100 * (panelElems.length - 1),
        ease: "none",
        scrollTrigger: {
          trigger: panelsContainer.value,
          pin: true,
          start: "top top",
          scrub: 1,
          snap: {
            snapTo: 1 / (panelElems.length - 1),
            inertia: false,
            duration: { min: 0.1, max: 0.1 },
          },
          end: () => "+=" + (panelsContainer.value.offsetWidth - window.innerWidth),
        },
      });

      const showAnim = gsap.fromTo(
        navbar.value,
        { yPercent: -100, opacity: 0 },
        { yPercent: 0, opacity: 1, paused: true, duration: 0.3 }
      ).progress(1);

      ScrollTrigger.create({
        start: "top top",
        end: "max",
        onUpdate: (self) => {
          self.direction === -1 ? showAnim.play() : showAnim.reverse();
        },
      });
      setInterval(() => {
        nextCard();
      }, 5000); 
    });

    const scrollToPanel = (index) => {
      const targetElem = document.querySelectorAll(".panel")[index];
      if (!targetElem || !panelsContainer.value.contains(targetElem)) return;
      const totalScroll = tween.scrollTrigger.end - tween.scrollTrigger.start;
      const totalMovement = (panels.value.length - 1) * targetElem.offsetWidth;
      const y = Math.round(
        tween.scrollTrigger.start + (targetElem.offsetLeft / totalMovement) * totalScroll
      );
      gsap.to(window, {
        scrollTo: { y, autoKill: false },
        duration: 1,
      });
    };

    const nextCard = () => {
      currentCard.value = (currentCard.value + 1) % galleryCards.value.length;
      updateGallery();
    };

    const prevCard = () => {
      currentCard.value =
        (currentCard.value - 1 + galleryCards.value.length) % galleryCards.value.length;
      updateGallery();
    };

    const updateGallery = () => {
      const cards = document.querySelectorAll(".cards li");
      cards.forEach((card, index) => {
        const position = (index - currentCard.value + galleryCards.value.length) % galleryCards.value.length;
        card.style.transform = `translateX(${position * 120}%)`;
        card.style.zIndex = position === 0 ? 10 : 1;
        card.style.opacity = position === 0 ? 1 : 0.5;
      });
    };

    onMounted(updateGallery);

    return { panelsContainer, navbar, panels, panelNames, scrollToPanel, galleryCards, nextCard, prevCard };
  },
};
</script>

<style>
#panels {
  overflow: hidden;
  position: relative;
}

.navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: rgba(0, 0, 0, 0.9);
  color: white;
  text-align: center;
  padding: 15px 0;
  font-size: 1.5rem;
  z-index: 2000;
}

.anchor {
  margin: 0 10px;
  cursor: pointer;
  text-decoration: none;
  color: white;
  background: #2980b9;
  padding: 8px 15px;
  border-radius: 5px;
  transition: background 0.3s;
}

.anchor:hover {
  background: #1abc9c;
}

#panels-container {
  display: flex;
  width: 500%;
}

.panel {
  flex: 1;
  min-width: 100vw;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  background: linear-gradient(135deg, #3498db, #9b59b6);
  color: white;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
}

.gallery {
  position: absolute;
  width: 100%;
  height: 100vh;
  overflow: hidden;
}

.cards {
  position: absolute;
  width: 14rem;
  height: 18rem;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  justify-content: center;
  align-items: center;
  transition: transform 0.3s ease-in-out;
}

.cards li {
  list-style: none;
  padding: 0;
  margin: 0;
  width: 25rem;
  height: 40rem;
  text-align: center;
  line-height: 18rem;
  font-size: 4rem;
  background-color: #9d7cce;
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 0.8rem;
  transition: transform 0.3s, opacity 0.3s;
}

.arrows {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
  transform: translateY(-50%);
}

.arrow {
  background: none;
  border: none;
  font-size: 2rem;
  color: white;
  cursor: pointer;
  padding: 0 10px;
}


button {
  display: inline-block;
  outline: none;
  border: none;
  padding: 8px 14px;
  background: #414141;
  background-image: -webkit-linear-gradient(top, #575757, #414141);
  background-image: -moz-linear-gradient(top, #575757, #414141);
  background-image: -ms-linear-gradient(top, #575757, #414141);
  background-image: -o-linear-gradient(top, #575757, #414141);
  background-image: linear-gradient(to bottom, #575757, #414141);
  text-shadow: 0px 1px 0px #414141;
  -webkit-box-shadow: 0px 1px 0px 414141;
  -moz-box-shadow: 0px 1px 0px 414141;
  box-shadow: 0px 1px 0px 414141;
  color: #ffffff;
  text-decoration: none;
  margin: 0 auto 10px;
  -webkit-border-radius: 4;
  -moz-border-radius: 4;
  border-radius: 4px;
  padding: 12px 25px;
  font-family: Mori;
  font-weight: 400;
  text-transform: uppercase;
  font-weight: 600;
  cursor: pointer;
  font-size: 20px;
  line-height: 18px;
}

button:hover {
  -webkit-box-shadow: 0px 1px 0px fefefe;
  -moz-box-shadow: 0px 1px 0px fefefe;
  box-shadow: 0px 1px 0px fefefe;
  color: #ffffff;
  text-decoration: none;
}

a {
  color: #88ce02;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

</style>
