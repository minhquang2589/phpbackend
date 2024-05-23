document.addEventListener('alpine:init', () => {
   Alpine.data('slider', () => ({
       currentIndex: 1,
       images: [
           'https://rakkiu.com/wp-content/uploads/2024/01/DSCF1637-scaled-e1706347480559.webp',
           'https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80',
           'https://www.nationsonline.org/gallery/Vietnam/Halong-Bay-Panorama.jpg',
       ],
       back() {
           if (this.currentIndex > 1) {
               this.currentIndex = this.currentIndex - 1;
           }
       },
       next() {
           if (this.currentIndex < this.images.length) {
               this.currentIndex = this.currentIndex + 1;
           } else {
               this.currentIndex = 1;
           }
       },
       // Tự động chuyển trang mỗi 1 giây
       autoNext() {
           setInterval(() => {
               this.next();
           }, 1000); 
       },
       mounted() {
           this.autoNext();
       },
   }))
})
