import React, { useState } from 'react';

const features = [
  { icon: '⚡', title: 'Instant Payments', desc: 'Send and receive payments globally in seconds.' },
  { icon: '🛡️', title: 'AI Security', desc: 'Advanced fraud detection and biometric authentication.' },
  { icon: '🌎', title: 'Global Reach', desc: 'Multi-currency support and cross-border transactions.' },
  { icon: '🔗', title: 'API Integrations', desc: 'Seamless integration with your business tools.' },
  { icon: '📱', title: 'Mobile First', desc: 'Optimized for all devices and platforms.' },
];

const testimonials = [
  { name: 'Jane Doe', text: 'Ultratech transformed our payment experience!' },
  { name: 'TechCorp', text: 'Reliable, fast, and secure. Highly recommended.' },
];

export default function LandingPageUltraTech() {
  const [showDemo, setShowDemo] = useState(false);

  return (
    <section className="ultra-landing p-4" style={{ fontFamily: 'Poppins, Outfit, sans-serif' }}>
      <div className="hero text-center py-5 position-relative">
        <h1 className="display-4 fw-bold animated-gradient">Revolutionize Your Payments</h1>
        <p className="lead mb-4">The Ultratech platform for instant, secure, global transactions.</p>
        <button className="cta-btn" onClick={() => setShowDemo(true)}>Try Live Demo</button>
        <div className="tech-stack mt-4 d-flex justify-content-center gap-2">
          <span className="badge bg-primary">Laravel</span>
          <span className="badge bg-success">React</span>
          <span className="badge bg-info text-dark">Vite</span>
          <span className="badge bg-warning text-dark">AI</span>
        </div>
        <div className="market-fit mt-4">
          <span className="badge bg-dark">Product-Market Fit</span>
        </div>
      </div>
      <div className="features row text-center py-4">
        {features.map((f, i) => (
          <div className="col-md-2 col-6 mb-3" key={i}>
            <div className="feature-card p-3 rounded shadow-sm h-100">
              <div className="feature-icon mb-2" style={{ fontSize: '2rem' }}>{f.icon}</div>
              <h5>{f.title}</h5>
              <p className="small text-muted">{f.desc}</p>
            </div>
          </div>
        ))}
      </div>
      <div className="social-proof py-4 text-center">
        <h6 className="mb-3">Trusted by <span className="counter">10,000+</span> businesses</h6>
        <div className="testimonials d-flex justify-content-center gap-3 flex-wrap">
          {testimonials.map((t, i) => (
            <div className="testimonial p-3 bg-light rounded shadow-sm" key={i}>
              <strong>{t.name}</strong>
              <p className="mb-0">{t.text}</p>
            </div>
          ))}
        </div>
      </div>
      <div className="lead-capture py-4 text-center">
        <h6>Get Early Access</h6>
        <form className="d-inline-flex gap-2 justify-content-center">
          <input type="email" className="form-control" placeholder="Your email" style={{ maxWidth: 220 }} required />
          <button type="submit" className="btn btn-primary">Sign Up</button>
        </form>
        <small className="d-block mt-2 text-muted">We respect your privacy.</small>
      </div>
      {showDemo && (
        <div className="demo-modal position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style={{ background: 'rgba(0,0,0,0.7)', zIndex: 9999 }}>
          <div className="bg-white p-4 rounded shadow-lg text-center" style={{ minWidth: 320 }}>
            <h4>Live Payment Demo</h4>
            <p>Simulate a payment flow and see Ultratech in action!</p>
            <button className="btn btn-success" onClick={() => setShowDemo(false)}>Close Demo</button>
          </div>
        </div>
      )}
      <style>{`
        .animated-gradient {
          background: linear-gradient(90deg,#007bff,#28a745,#ffc107);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          animation: gradientMove 3s infinite linear alternate;
        }
        @keyframes gradientMove {
          0%{background-position:0% 50%;}100%{background-position:100% 50%;}
        }
        .cta-btn {
          background: linear-gradient(90deg,#007bff,#28a745);
          color: #fff; border: none; border-radius: 8px; padding: 0.75em 2em; font-size: 1.2rem; font-weight: 600;
          box-shadow: 0 4px 16px rgba(0,0,0,0.08);
          transition: transform 0.2s;
        }
        .cta-btn:hover { transform: scale(1.05); background: linear-gradient(90deg,#28a745,#007bff); }
        .feature-card { transition: box-shadow 0.2s; }
        .feature-card:hover { box-shadow: 0 8px 24px rgba(0,123,255,0.15); }
        .counter { font-weight: bold; color: #007bff; font-size: 1.2em; }
        .demo-modal { animation: fadeIn 0.3s; }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
      `}</style>
    </section>
  );
}
