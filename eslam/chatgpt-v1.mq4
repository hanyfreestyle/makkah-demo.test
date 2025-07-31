// Cleaned version of Amro_Magnetic_Numbers(all_brokersss).mq4
// Only keeps LL1‑5, LL10‑14, HL1‑5, HL10‑14 variables.
// Unused variables and functions referencing removed levels have been deleted per user request.

#property indicator_chart_window
#property indicator_buffers 0
#property strict

// --- External Inputs ---------------------------------------------------
extern string note="MT4 Time Setting";
extern int    time_hour      = 0;
extern int    start_week_day = 1;
extern int    start_week_hour= 0;
extern int    end_week_bar_missing = 1;
extern int    Nbars_of_day   = 1;

extern string note1="H1‑H5 Setting (+)";
extern color  color1 = Green;
extern int    width1 = 2;
extern int    style1 = 0;

extern string note2="H10‑H14 Setting (‑)";
extern color  color2 = LightGreen;
extern int    width2 = 2;
extern int    style2 = 0;

extern string note3="L1‑L5 Setting (+)";
extern color  color3 = Pink;
extern int    width3 = 2;
extern int    style3 = 0;

extern string note4="L10‑L14 Setting (‑)";
extern color  color4 = Violet;
extern int    width4 = 2;
extern int    style4 = 0;

extern string note5="Rectangle Zone Settings";
extern bool   draw_attraction_zone = true;
extern color  Rec_color1 = Snow;
extern color  Rec_color2 = PaleGoldenrod;

extern string note6="Comment Setting";
extern int    corner = 0;

extern string note7="Column 1 (High Levels)";
extern int    xdis1 = 10;
extern int    ydis1 = 10;
extern int    font_size1 = 10;
extern string font_type1 = "Arial";
extern color  font_color1 = Lime;

extern string note8="Column 2 (Low Levels)";
extern int    xdis2 = 70;
extern int    ydis2 = 10;
extern int    font_size2 = 10;
extern string font_type2 = "Arial";
extern color  font_color2 = Yellow;

extern string note9="Price Label Setting";
extern bool   show_price_Label = true;
extern int    size   = 1;          // wingdings size
extern int    x_dis_LL = 7;        // x offset for LL labels
extern int    x_dis_HL = 1;        // x offset for HL labels

extern bool   Del_All_Objects = false; // quick clean‑up switch

// --- Globals -----------------------------------------------------------
double HL1,HL2,HL3,HL4,HL5,HL10,HL11,HL12,HL13,HL14;
double LL1,LL2,LL3,LL4,LL5,LL10,LL11,LL12,LL13,LL14;
double rang1,rang2,rang3,rang4,rang5;

static int day  = -1;      // last processed day
static int valid=  0;

//=======================================================================
// Helper: delete today’s objects when day changes
void deletobject()
{
   int total = ObjectsTotal();
   string today = TimeToStr(Time[0], TIME_DATE);
   for(int i = total‑1; i >= 0; i‑‑)
   {
      string obj = ObjectName(i);
      if(StringFind(obj, today) >= 0) ObjectDelete(obj);
   }
}

// Helper: draw horizontal line
void Tline(string name, int barShift, double price, int lineWidth, color lineColor, int lineStyle, string label="")
{
   if(ObjectFind(name) < 0)
      ObjectCreate(name, OBJ_HLINE, 0, Time[barShift], price);
   ObjectSet(name, OBJPROP_PRICE1, price);
   ObjectSet(name, OBJPROP_STYLE, lineStyle);
   ObjectSet(name, OBJPROP_WIDTH, lineWidth);
   ObjectSet(name, OBJPROP_COLOR, lineColor);
   if(label!="") ObjectSetText(name, label, font_size1, font_type1, lineColor);
}

// Helper: optionally draw price label
void drawPrice(string name, double price, color col, int sz, int xOff, int barShift, string extra="")
{
   if(!show_price_Label) return;
   if(ObjectFind(name) < 0)
      ObjectCreate(name, OBJ_TEXT, 0, Time[barShift], price);
   ObjectSet(name, OBJPROP_PRICE1, price);
   ObjectSet(name, OBJPROP_COLOR, col);
   ObjectSetInteger(0, OBJPROP_CORNER, corner);
   ObjectSet(name, OBJPROP_ANCHOR, ANCHOR_LEFT);
   ObjectSetText(name, (string)DoubleToString(price, Digits)+extra, sz, font_type1, col);
}

//=======================================================================
//  MAIN: called every tick
int start()
{
   if(Period() != PERIOD_H1) return(0);

   // delete objects if new day reached
   if(TimeDay(Time[0]) != day)
   {
      deletobject();
      day = TimeDay(Time[0]);
   }
   else return(0);

   //--- Calculate today High / Low -------------------------------------
   datetime startTime = iTime(Symbol(), PERIOD_D1, 0);
   datetime endTime   = startTime + 86400;
   double high = ‑DBL_MAX;
   double low  =  DBL_MAX;

   for(int i = 0; i < Bars; i++)
   {
      datetime t = Time[i];
      if(t >= startTime && t < endTime)
      {
         if(High[i] > high) high = High[i];
         if(Low[i]  < low)  low  = Low[i];
      }
   }

   double golden_range = high‑low;
   // simple equal divisions – replace with your gn logic if needed
   rang1 = golden_range * 0.236;
   rang2 = golden_range * 0.382;
   rang3 = golden_range * 0.500;
   rang4 = golden_range * 0.618;
   rang5 = golden_range * 1.000;

   //--- Compute Levels --------------------------------------------------
   HL1  = high + rang1;
   HL2  = high + rang2;
   HL3  = high + rang3;
   HL4  = high + rang4;
   HL5  = high + rang5;
   HL10 = high ‑ rang1;
   HL11 = high ‑ rang2;
   HL12 = high ‑ rang3;
   HL13 = high ‑ rang4;
   HL14 = high ‑ rang5;

   LL1  = low  + rang1;
   LL2  = low  + rang2;
   LL3  = low  + rang3;
   LL4  = low  + rang4;
   LL5  = low  + rang5;
   LL10 = low  ‑ rang1;
   LL11 = low  ‑ rang2;
   LL12 = low  ‑ rang3;
   LL13 = low  ‑ rang4;
   LL14 = low  ‑ rang5;

   //--- Draw High‑side lines ------------------------------------------
   string d = TimeToStr(Time[0], TIME_DATE);
   Tline("HL1 "+d, 0, HL1,  width1, color1, style1, "= "+DoubleToStr(HL1,Digits));
   Tline("HL2 "+d, 0, HL2,  width1, color1, style1, "= "+DoubleToStr(HL2,Digits));
   Tline("HL3 "+d, 0, HL3,  width1, color1, style1, "= "+DoubleToStr(HL3,Digits));
   Tline("HL4 "+d, 0, HL4,  width1, color1, style1, "= "+DoubleToStr(HL4,Digits));
   Tline("HL5 "+d, 0, HL5,  width1, color1, style1, "= "+DoubleToStr(HL5,Digits));

   Tline("HL10 "+d,0, HL10, width2, color2, style2, "= "+DoubleToStr(HL10,Digits));
   Tline("HL11 "+d,0, HL11, width2, color2, style2, "= "+DoubleToStr(HL11,Digits));
   Tline("HL12 "+d,0, HL12, width2, color2, style2, "= "+DoubleToStr(HL12,Digits));
   Tline("HL13 "+d,0, HL13, width2, color2, style2, "= "+DoubleToStr(HL13,Digits));
   Tline("HL14 "+d,0, HL14, width2, color2, style2, "= "+DoubleToStr(HL14,Digits));

   //--- Draw Low‑side lines -------------------------------------------
   Tline("LL1 "+d, 0, LL1,  width3, color3, style3, "= "+DoubleToStr(LL1,Digits));
   Tline("LL2 "+d, 0, LL2,  width3, color3, style3, "= "+DoubleToStr(LL2,Digits));
   Tline("LL3 "+d, 0, LL3,  width3, color3, style3, "= "+DoubleToStr(LL3,Digits));
   Tline("LL4 "+d, 0, LL4,  width3, color3, style3, "= "+DoubleToStr(LL4,Digits));
   Tline("LL5 "+d, 0, LL5,  width3, color3, style3, "= "+DoubleToStr(LL5,Digits));

   Tline("LL10 "+d,0, LL10, width4, color4, style4, "= "+DoubleToStr(LL10,Digits));
   Tline("LL11 "+d,0, LL11, width4, color4, style4, "= "+DoubleToStr(LL11,Digits));
   Tline("LL12 "+d,0, LL12, width4, color4, style4, "= "+DoubleToStr(LL12,Digits));
   Tline("LL13 "+d,0, LL13, width4, color4, style4, "= "+DoubleToStr(LL13,Digits));
   Tline("LL14 "+d,0, LL14, width4, color4, style4, "= "+DoubleToStr(LL14,Digits));

   //--- Optional price labels -----------------------------------------
   drawPrice("price_HL1",  HL1,  color1, size, x_dis_HL, 0);
   drawPrice("price_HL14", HL14, color2, size, x_dis_HL, 0);
   drawPrice("price_LL1",  LL1,  color3, size, x_dis_LL, 0);
   drawPrice("price_LL14", LL14, color4, size, x_dis_LL, 0);

   return(0);
}

//=======================================================================
//  Clean‑up helper – called manually by setting Del_All_Objects = true
int deinit()
{
   if(Del_All_Objects)
   {
      int total = ObjectsTotal();
      for(int i = total‑1; i >= 0; i‑‑) ObjectDelete(ObjectName(i));
   }
   return(0);
}
