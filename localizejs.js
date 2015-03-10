!function(a){if(!a.Localize){a.Localize={};for(var e=["translate","untranslate","phrase","initialize","translatePage","setLanguage","getLanguage","detectLanguage","untranslatePage","bootstrap","prefetch","on","off"],t=0;t<e.length;t++)a.Localize[e[t]]=function(){}}}(window);

if (PROJECT_KEY) {
	Localize.initialize({ key: PROJECT_KEY, rememberLanguage: true, saveNewPhrases: true, translateBody: true });
} else {
	Localize.initialize({ key: "RnyUk5qvqgkKm", rememberLanguage: true, saveNewPhrases: true, translateBody: true });
}