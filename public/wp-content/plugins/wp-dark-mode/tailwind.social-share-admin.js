const colors = require("tailwindcss/colors");

module.exports = {
  content: [ 
    "./templates/admin/social-share/*.php",
    "./src/js/social-share-admin.js",
    "./src/js/components/webcomponents.js",
  ],
  theme: {
    extend: {},     
  },
  variants: {
    extend: {
      opacity: ["disabled"],
      animation: ["hover", "focus"],
      userSelect: ["hover", "focus"],
    },
  },
  plugins: [
    require("tailwindcss"),
    require('@tailwindcss/forms'),
    require("tailwind-scrollbar")
  ],
  important: false,
};