<template>
    <div id="panels">
      <header class="navbar main-tool-bar" ref="navbar">
        <h1>Vue GSAP Panels</h1>
        
      </header>
      <nav class="nav-container">
        <a v-for="(panel, index) in panels" :key="index" href="#" @click.prevent="scrollToPanel(index)" class="anchor">
          Panel {{ index + 1 }}
        </a>
      </nav>
      <div id="panels-container" ref="panelsContainer">
        <div v-for="(panel, index) in panels" :key="index" class="panel">
          Panel {{ index + 1 }}
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
              duration: { min: 0.1, max: 0.1 }
            },
            end: () => "+=" + (panelsContainer.value.offsetWidth - window.innerWidth)
          }
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
          }
        });
      });
  
      const scrollToPanel = (index) => {
        const targetElem = document.querySelectorAll(".panel")[index];
        if (!targetElem || !panelsContainer.value.contains(targetElem)) return;
        const totalScroll = tween.scrollTrigger.end - tween.scrollTrigger.start;
        const totalMovement = (panels.value.length - 1) * targetElem.offsetWidth;
        const y = Math.round(tween.scrollTrigger.start + (targetElem.offsetLeft / totalMovement) * totalScroll);
        gsap.to(window, {
          scrollTo: { y, autoKill: false },
          duration: 1
        });
      };
  
      return { panelsContainer, navbar, panels, scrollToPanel };
    }
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
  
  .nav-container {
    position: fixed;
    top: 60px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1500;
    background: rgba(0, 0, 0, 0.7);
    padding: 10px;
    border-radius: 10px;
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
  </style>
  