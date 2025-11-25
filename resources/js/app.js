import './bootstrap';

// Vercel Speed Insights (client-only) - collects page performance metrics
try {
	// dynamically import to avoid breaking server-side tooling
	if (typeof window !== 'undefined') {
		import('@vercel/speed-insights').then(mod => {
			if (mod && typeof mod.injectSpeedInsights === 'function') {
				mod.injectSpeedInsights();
			}
		}).catch(e => {
			// don't crash the app if metrics library isn't available
			// console.debug('Speed Insights import failed', e);
		});
	}
} catch (e) {
	// nothing to do, metrics are optional
}
