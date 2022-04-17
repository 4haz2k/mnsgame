module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue"
    ],
    theme: {
        screens: {
            'mdm': {'max': '1024px'},
            'lg' : {'min': '1024px'}
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
