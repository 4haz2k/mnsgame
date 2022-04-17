module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue"
    ],
    theme: {
        screens: {
            'sm' : {'min' : '640px'},
            'mdm': {'max': '1024px'},
            'lg' : {'min': '1024px'},
            'md': {'min' : '768px'},
            'xl': {'min' : '1280px'}
        },
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
    variants: {
        display: ["group-hover"]
    },
}
