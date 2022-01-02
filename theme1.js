export const theme = {
    "lineHeights": {"solid": 1},
    "fonts": {"heading": "Segoe UI", "body": "Segoe UI"},
    "borderRadius": ["30%", "15%", "8%"],
    "borderStyles": ["solid"],
    "borderWidths": ["1rem", "0.5rem", "0.1rem", "0.225rem"],
    "fontSizes": ["1rem", "2rem", "0.5rem", "3rem"],
    "space": ["1rem"],
    "colors": {
        "gray": ["#000000", "#1c1c1c", "#303030", "#474747", "#5d5d5d", "#757575", "#8c8c8c", "#a3a3a3", "#bababa", "#d1d1d1", "#e8e8e8", "#ffffff"],
        "blue-gray": ["#0e0e11", "#21222a", "#343544", "#484a5e", "#5c5f78", "#717490", "#8789a6", "#9c9eba", "#b1b3cb", "#c6c8db", "#dcdce9", "#f1f1f6"],
        "blue": ["#0d0e1a", "#182142", "#1e336d", "#254797", "#325bbd", "#476fde", "#6284f6", "#809aff", "#9fb0ff", "#bcc6ff", "#d9deff", "#f4f5ff"],
        "indigo": ["#120c1d", "#211b4d", "#2f297f", "#3e38b0", "#5049dd", "#675bff", "#8170ff", "#9d87ff", "#b7a0ff", "#d0baff", "#e5d6ff", "#f7f1ff"],
        "violet": ["#170a1b", "#321545", "#501b71", "#6d239d", "#8a2fc5", "#a641e7", "#be58ff", "#d374ff", "#e392ff", "#f0b1ff", "#f9d0ff", "#fef0ff"],
        "magenta": ["#170915", "#381436", "#5b1859", "#7f1e7c", "#a0289d", "#bf3abb", "#d853d2", "#ea70e4", "#f78ff0", "#ffaef8", "#ffcefc", "#ffeefe"],
        "red": ["#19090a", "#3e131a", "#651829", "#8d1d38", "#b22749", "#d23a5b", "#ec5370", "#ff7086", "#ff909e", "#ffb0b9", "#ffd0d4", "#fff0f1"],
        "orange": ["#200d02", "#431706", "#691e0a", "#8e280d", "#b13514", "#d14721", "#ea5e36", "#fd7950", "#ff9670", "#ffb495", "#ffd2be", "#fff0e9"],
        "gold": ["#160f05", "#402e11", "#6e4d14", "#9c6c18", "#c68a20", "#eba62e", "#ffbe44", "#ffd15e", "#ffe07c", "#ffeb9b", "#fff3bc", "#fffade"],
        "yellow": ["#0d0c04", "#332f11", "#585315", "#7f7719", "#a49a20", "#c5ba2c", "#e1d43f", "#f6e857", "#fff673", "#fffe90", "#ffffae", "#ffffcc"],
        "lime": ["#161708", "#323711", "#505a15", "#6e7c19", "#8b9c22", "#a6b932", "#bed049", "#d1e264", "#e1ee83", "#edf6a3", "#f6fbc4", "#fcfee6"],
        "green": ["#071209", "#102816", "#133f21", "#18572d", "#216f3b", "#32864b", "#499c60", "#66b178", "#85c492", "#a7d6af", "#cae7cf", "#eef7ef"],
        "teal": ["#07110f", "#102722", "#133d35", "#18544a", "#216b5e", "#328173", "#499789", "#65ac9e", "#85c0b3", "#a7d3c9", "#cae5de", "#eef7f4"],
        "cyan": ["#081111", "#112627", "#143c3e", "#185356", "#226a6d", "#338084", "#4b969a", "#67abae", "#87bfc1", "#a8d2d4", "#cbe4e5", "#eef6f7"],
        "modes": {
            "default": {
                "background": "#f4f5ff",
                "text": "#501b71",
                "border": "#bababa",
                "primary": "#f0b1ff",
                "accent": "#d853d2",
                "muted": "#85c492"
            },
            "dark": {
                "background": "#be58ff",
                "text": "#501b71",
                "border": "#9c9eba",
                "primary": "#143c3e",
                "accent": "#f0b1ff",
                "muted": "#499c60"
            },
            "dim": {
                "background": "#fef0ff",
                "text": "#be58ff",
                "border": "#6d239d",
                "primary": "#a641e7",
                "accent": "#e5d6ff",
                "muted": "#484a5e"
            }
        }
    },
    "breakpoints": ["768px", "1080px"],
    "name": "Color System - LAB (Natural)",
    "description": "Expansive color system with scales generated from LAB - Natural.\n\n6th step in each scale is accessible with white and black with gold, yellow, and lime scales using the 4th step.\n\n168 colors\n8,816 accessible colors\n6th step in each scale (excluding gold, yellow, and lime) is accessible with white and black",
    "gradients": {
        "0": "repeating-radial-gradient(circle at 60% 68%, #85c492 28%, #216b5e 91%)",
        "1": "linear-gradient(279deg, #85c492 26%, #4b969a 94%)",
        "2": "linear-gradient(246deg, #d853d2 22%, #f0b1ff 74%)",
        "3": "linear-gradient(269deg, #32864b 46%, #a49a20 81%)",
        "4": "repeating-linear-gradient(221deg, #d853d2 55%, #f0b1ff 92%)"
    },
    "letterSpacings": {"tracked": "0.1em"},
    "text": {
        "heading": {
            "font-family": "heading",
            "font-weight": 700,
            "line-height": "1",
            "letter-spacing": "0.1rem",
            "font-size": 2,
            "font-variant": "small-caps",
            "text-align": "justify",
            "text-transform": "capitalize",
            "text-decoration": "none",
            "word-break": "keep-all"
        }, "body": {"font-family": "heading", "font-weight": 300, "line-height": "1", "letter-spacing": "0.1em"}
    },
    "boxShadows": {
        "md": "0 1px 1px rgba(0,0,0,0.125), 0 2px 2px rgba(0,0,0,0.125), 0 4px 4px rgba(0,0,0,0.125), 0 8px 8px rgba(0,0,0,0.125), 0 16px 16px rgba(0,0,0,0.125)",
        "sm": "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)",
        "lg": "0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22)"
    },
    "textShadows": {
        "0": "0rem 0rem 20px hsla(253.57,81.85%,40.39%,0.755)",
        "1": "0rem 0rem 20px hsla(200.71,89%,11%,0.938)"
    }
}
