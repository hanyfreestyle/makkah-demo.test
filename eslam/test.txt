//+------------------------------------------------------------------+
//|                                       Amro_magnetic(AwadKAB).mq4 |
//|                               Copyright © 2011, AwadKAB Software |
//|                                awadkab@hotmail.com               |
//+------------------------------------------------------------------+
#property copyright "Copyright © 2011, AwadKAB Software"
#property link      ""

#property indicator_chart_window
extern string note="MT4 Time Setting";
extern int time_hour=0;
extern int start_week_day=1;
extern int start_week_hour=0;
extern int end_week_bar_missing=1;
extern int Nbars_of_day=1;
extern string note1="H1-H5 Setting";
extern color color1=Green;
extern int width1=2;
extern int style1=0;
extern string note2="H10-H14 Setting";
extern color color2=LightGreen;
extern int width2=2;
extern int style2=0;
extern string note3="L1-L5 Setting";
extern color color3=Pink;
extern int width3=2;
extern int style3=0;
extern string note4="L10-L14 Setting";
extern color color4=Red;
extern int width4=2;
extern int style4=0;
extern string note5="Rectangle Color";
extern color Rec_color1=Gray;
extern color Rec_color2=PaleGoldenrod;
extern string note6="Comment Setting";
extern int corner=0;
extern string note7="Column 1";
extern int xdis1=10;
extern int ydis1=10;
extern int font_size1=10;
extern string font_type1="Arial";
extern color font_color1=Lime;
extern string note8="Column 2";
extern int xdis2=70;
extern int ydis2=10;
extern int font_size2=10;
extern string font_type2="Arial";
extern color font_color2=Yellow;
extern string note9="Price Label Setting";
extern bool show_price_Label=true;
extern int size=1;
extern int x_dis_LL=7;
extern int x_dis_HL=1;

extern bool Del_All_Objects=false;
static int day=0;
//+------------------------------------------------------------------+
//| Custom indicator initialization function                         |
//+------------------------------------------------------------------+
int init()
  {
//---- indicators
//----
   return(0);
  }
//+------------------------------------------------------------------+
//| Custom indicator deinitialization function                       |
//+------------------------------------------------------------------+
int deinit()
  {
//----
if(Del_All_Objects==true) deletobject();
//----
   return(0);
  }


//+------------------------------------------------------------------+
//| Custom indicator iteration function                              |
//+------------------------------------------------------------------+
int start()
  {
if(Period()!=PERIOD_H1) return(0);
  static int valid;
// Keep only required variables
double  HL1,HL2,HL3,HL4,HL5,HL10,HL11,HL12,HL13,HL14;
double LL1,LL2,LL3,LL4,LL5,LL10,LL11,LL12,LL13,LL14;
double rang1,rang2,rang3,rang4,rang5;

static double  high,low;

if(TimeDay(Time[0])!=day){deletobject(); day=TimeDay(Time[0]);}
else return(0);

   int   i;
//----
  int Nbars=Nbars_of_day*26;
  double gn1=1.618033989;
  double gn2=0.618033989;
  double dig=1,dd=0;
        int limit,b;
//----

for (i=Nbars;i>=0;i--)
 {
//--------
int barT1=iBarShift(Symbol(),PERIOD_H1,Time[i],false);
      if(TimeHour(Time[barT1])==time_hour||(TimeDayOfWeek(Time[barT1])==start_week_day&&TimeHour(Time[barT1])==start_week_hour))
      {

      if(TimeDayOfWeek(Time[i])==start_week_day) dd=24-end_week_bar_missing;
      else dd=24;
      high=NormalizeDouble(iHigh(Symbol(),60,iHighest(Symbol(),60,MODE_HIGH,dd,barT1+1)),Digits)/Point;
      low=NormalizeDouble(iLow(Symbol(),60,iLowest(Symbol(),60,MODE_LOW,dd,barT1+1)),Digits)/Point;

               if(Digits==2||Digits==4){ high=high*10; low=low*10; dig=10;}

         double range=high-low;

         double golden_range=(MathSqrt(range+(range*gn2)))*10;
         rang1=golden_range*gn1;
         rang2=golden_range*(gn1+1);
         rang3=golden_range*(gn1+2);
         rang4=golden_range*(gn1+3);
         rang5=golden_range*(gn1+4);

         //--HL---
         HL1 = high + rang1;
         HL2 = high + rang2;
         HL3 = high + rang3;
         HL4 = high + rang4;
         HL5 = high + rang5;
         HL10 = high - rang1;
         HL11 = high - rang2;
         HL12 = high - rang3;
         HL13 = high - rang4;
         HL14 = high - rang5;

         //--LL---
         LL1 = low + rang1;
         LL2 = low + rang2;
         LL3 = low + rang3;
         LL4 = low + rang4;
         LL5 = low + rang5;
         LL10 = low - rang1;
         LL11 = low - rang2;
         LL12 = low - rang3;
         LL13 = low - rang4;
         LL14 = low - rang5;

        // Draw lines for HL1-HL5
        Tline("HL1"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL1*Point/dig,Digits),width1,color1,style1,"= "+DoubleToStr(NormalizeDouble(HL1*Point/dig,Digits),Digits));
        Tline("HL2"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL2*Point/dig,Digits),width1,color1,style1,"= "+DoubleToStr(NormalizeDouble(HL2*Point/dig,Digits),Digits));
        Tline("HL3"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL3*Point/dig,Digits),width1,color1,style1,"= "+DoubleToStr(NormalizeDouble(HL3*Point/dig,Digits),Digits));
        Tline("HL4"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL4*Point/dig,Digits),width1,color1,style1,"= "+DoubleToStr(NormalizeDouble(HL4*Point/dig,Digits),Digits));
        Tline("HL5"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL5*Point/dig,Digits),width1,color1,style1,"= "+DoubleToStr(NormalizeDouble(HL5*Point/dig,Digits),Digits));

        // Draw lines for HL10-HL14
        Tline("HL10"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL10*Point/dig,Digits),width2,color2,style2,"= "+DoubleToStr(NormalizeDouble(HL10*Point/dig,Digits),Digits)+"\n Magnetic Area = "+DoubleToStr(LL1/dig-HL10/dig,0)+" Pips");
        Tline("HL11"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL11*Point/dig,Digits),width2,color2,style2,"= "+DoubleToStr(NormalizeDouble(HL11*Point/dig,Digits),Digits));
        Tline("HL12"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL12*Point/dig,Digits),width2,color2,style2,"= "+DoubleToStr(NormalizeDouble(HL12*Point/dig,Digits),Digits));
        Tline("HL13"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL13*Point/dig,Digits),width2,color2,style2,"= "+DoubleToStr(NormalizeDouble(HL13*Point/dig,Digits),Digits));
        Tline("HL14"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(HL14*Point/dig,Digits),width2,color2,style2,"= "+DoubleToStr(NormalizeDouble(HL14*Point/dig,Digits),Digits));

        // Draw lines for LL1-LL5
        Tline("LL1"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL1*Point/dig,Digits),width3,color3,style3,"= "+DoubleToStr(NormalizeDouble(LL1*Point/dig,Digits),Digits)+"\n Magnetic Area = "+DoubleToStr(LL1/dig-HL10/dig,0)+" Pips");
        Tline("LL2"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL2*Point/dig,Digits),width3,color3,style3,"= "+DoubleToStr(NormalizeDouble(LL2*Point/dig,Digits),Digits));
        Tline("LL3"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL3*Point/dig,Digits),width3,color3,style3,"= "+DoubleToStr(NormalizeDouble(LL3*Point/dig,Digits),Digits));
        Tline("LL4"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL4*Point/dig,Digits),width3,color3,style3,"= "+DoubleToStr(NormalizeDouble(LL4*Point/dig,Digits),Digits));
        Tline("LL5"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL5*Point/dig,Digits),width3,color3,style3,"= "+DoubleToStr(NormalizeDouble(LL5*Point/dig,Digits),Digits));

        // Draw lines for LL10-LL14
        Tline("LL10"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL10*Point/dig,Digits),width4,color4,style4,"= "+DoubleToStr(NormalizeDouble(LL10*Point/dig,Digits),Digits));
        Tline("LL11"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL11*Point/dig,Digits),width4,color4,style4,"= "+DoubleToStr(NormalizeDouble(LL11*Point/dig,Digits),Digits));
        Tline("LL12"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL12*Point/dig,Digits),width4,color4,style4,"= "+DoubleToStr(NormalizeDouble(LL12*Point/dig,Digits),Digits));
        Tline("LL13"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL13*Point/dig,Digits),width4,color4,style4,"= "+DoubleToStr(NormalizeDouble(LL13*Point/dig,Digits),Digits));
        Tline("LL14"+" "+TimeToStr(Time[i],TIME_DATE),barT1,NormalizeDouble(LL14*Point/dig,Digits),width4,color4,style4,"= "+DoubleToStr(NormalizeDouble(LL14*Point/dig,Digits),Digits));

        // Draw magnetic area rectangle
        if(HL10<LL1)
        {
        Rec("Magnetic Area"+" "+TimeToStr(Time[i],TIME_DATE),i,HL10*Point/dig,LL1*Point/dig,1,Rec_color1,0);
        }else
        {
         Rec("Magnetic Area"+" "+TimeToStr(Time[i],TIME_DATE),i,HL10*Point/dig,LL1*Point/dig,1,Rec_color2,0);
        }

if(barT1<=23)
{
valid=barT1;
   drawL("Range1",xdis1,ydis1,"Range 1", font_size1, font_type1, font_color1,corner);
   drawL("Range2",xdis1,ydis1+20,"Range 2", font_size1, font_type1, font_color1,corner);
   drawL("Range3",xdis1,ydis1+20*2,"Range 3", font_size1, font_type1, font_color1,corner);
   drawL("Range4",xdis1,ydis1+20*3,"Range 4", font_size1, font_type1, font_color1,corner);
   drawL("Range5",xdis1,ydis1+20*4,"Range 5", font_size1, font_type1, font_color1,corner);
   drawL("Today_Range",xdis1,ydis1+20*5,"Today_Range", font_size1, font_type1, font_color1,corner);
   drawL("Pre_day_Range",xdis1,ydis1+20*6,"Pre_day_Range", font_size1, font_type1, font_color1,corner);
   drawL("===",xdis1,ydis1+20*7,"=======", font_size1, font_type1, font_color1,corner);
   drawL("Pw_High",xdis1,ydis1+20*8,"Pw High", font_size1, font_type1, font_color1,corner);
   drawL("Pw_Low",xdis1,ydis1+20*9,"Pw Low", font_size1, font_type1, font_color1,corner);
   drawL("Pw_Open",xdis1,ydis1+20*10,"Pw Open", font_size1, font_type1, font_color1,corner);

   drawL("Range12",xdis2,ydis2,DoubleToStr(rang1/dig,0), font_size2, font_type2, font_color2,corner);
   drawL("Range22",xdis2,ydis2+20,DoubleToStr(rang2/dig,0), font_size2, font_type2, font_color2,corner);
   drawL("Range32",xdis2,ydis2+20*2,DoubleToStr(rang3/dig,0), font_size2, font_type2, font_color2,corner);
   drawL("Range42",xdis2,ydis2+20*3,DoubleToStr(rang4/dig,0), font_size2, font_type2, font_color2,corner);
   drawL("Range52",xdis2,ydis2+20*4,DoubleToStr(rang5/dig,0), font_size2, font_type2, font_color2,corner);

   drawL("Pre_day_Range_",xdis2+35,ydis2+20*6,DoubleToStr((high-low)/dig,0), font_size2, font_type2, font_color2,corner);

   drawL("Pw_Highh",xdis2,ydis2+20*8,DoubleToStr(trim(high),0), font_size2, font_type2, font_color2,corner);
   drawL("Pw_Loww",xdis2,ydis2+20*9,DoubleToStr(trim(low),0), font_size2, font_type2, font_color2,corner);
   drawL("Pw_Openn",xdis2,ydis2+20*10,DoubleToStr(trim(iOpen(Symbol(),PERIOD_H1,barT1)/Point),0), font_size2, font_type2, font_color2,corner);

   if(show_price_Label==true)
   {
   if(time_hour>0)  {int addL=60*60*24+x_dis_LL*60*60; int addH=60*60*24+60*60*x_dis_HL;}
   else {addL=60*60*24+60*60*x_dis_LL; addH=60*60*24+60*60*x_dis_HL;}

   // Price labels for LL1-LL5
   drawPrice("price_LL1",NormalizeDouble(LL1*Point/dig,Digits),color3,size,0,i,addL);
   drawPrice("price_LL2",NormalizeDouble(LL2*Point/dig,Digits),color3,size,1,i,addL);
   drawPrice("price_LL3",NormalizeDouble(LL3*Point/dig,Digits),color3,size,1,i,addL);
   drawPrice("price_LL4",NormalizeDouble(LL4*Point/dig,Digits),color3,size,1,i,addL);
   drawPrice("price_LL5",NormalizeDouble(LL5*Point/dig,Digits),color3,size,1,i,addL);

   // Price labels for LL10-LL14
   drawPrice("price_LL10",NormalizeDouble(LL10*Point/dig,Digits),color4,size,1,i,addL);
   drawPrice("price_LL11",NormalizeDouble(LL11*Point/dig,Digits),color4,size,1,i,addL);
   drawPrice("price_LL12",NormalizeDouble(LL12*Point/dig,Digits),color4,size,1,i,addL);
   drawPrice("price_LL13",NormalizeDouble(LL13*Point/dig,Digits),color4,size,1,i,addL);
   drawPrice("price_LL14",NormalizeDouble(LL14*Point/dig,Digits),color4,size,1,i,addL);

   // Price labels for HL1-HL5
   drawPrice("price_HL1",NormalizeDouble(HL1*Point/dig,Digits),color1,size,1,i,addH);
   drawPrice("price_HL2",NormalizeDouble(HL2*Point/dig,Digits),color1,size,1,i,addH);
   drawPrice("price_HL3",NormalizeDouble(HL3*Point/dig,Digits),color1,size,1,i,addH);
   drawPrice("price_HL4",NormalizeDouble(HL4*Point/dig,Digits),color1,size,1,i,addH);
   drawPrice("price_HL5",NormalizeDouble(HL5*Point/dig,Digits),color1,size,1,i,addH);

   // Price labels for HL10-HL14
   drawPrice("price_HL10",NormalizeDouble(HL10*Point/dig,Digits),color2,size,1,i,addH);
   drawPrice("price_HL11",NormalizeDouble(HL11*Point/dig,Digits),color2,size,1,i,addH);
   drawPrice("price_HL12",NormalizeDouble(HL12*Point/dig,Digits),color2,size,1,i,addH);
   drawPrice("price_HL13",NormalizeDouble(HL13*Point/dig,Digits),color2,size,1,i,addH);
   drawPrice("price_HL14",NormalizeDouble(HL14*Point/dig,Digits),color2,size,1,i,addH);
}

}
}
  }    //----
 double today_h=NormalizeDouble(iHigh(Symbol(),PERIOD_H1,iHighest(Symbol(),PERIOD_H1,MODE_HIGH,valid+1,0)),Digits)/Point;
 double today_l=NormalizeDouble(iLow(Symbol(),PERIOD_H1,iLowest(Symbol(),PERIOD_H1,MODE_LOW,valid+1,0)),Digits)/Point;

  drawL("Today_Range_",xdis2+30,ydis2+20*5,DoubleToStr((today_h-today_l),0), font_size2, font_type2, font_color2,corner);

   return(0);
  }
//+------------------------Trend Drawing------------------------------------------+
void Tline(string name,int i,double p1,int width1,color color1,int style1,string des)
{datetime b;

 if(TimeDayOfWeek(Time[i])!=start_week_day)
  {
    if(time_hour!=0)  b=StrToTime(TimeToStr(Time[i]+60*60*24,TIME_DATE)+" "+(time_hour-1));
      else b=StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+"23:00");
  }
  else
  {
   if(time_hour!=0)  {b=StrToTime(TimeToStr(Time[i]+60*60*24,TIME_DATE)+" "+(time_hour-1)); }
   if(time_hour!=0&&TimeHour(Time[i])==0&&start_week_hour==0)  {b=StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+(time_hour-1)); }
   if(time_hour==0) b=StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+"23:00");
  }

if((TimeDayOfWeek(Time[i])==start_week_day&&TimeHour(Time[i])==0)) name=name+" ";
   ObjectCreate(name,OBJ_TREND,0,0,0,0,0);
   ObjectSet(name,OBJPROP_PRICE1,p1);

   if((TimeDayOfWeek(Time[i])==start_week_day&&TimeHour(Time[i])==0)){ObjectSet(name,OBJPROP_TIME1,StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+0)); }
   else {ObjectSet(name,OBJPROP_TIME1,StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+time_hour));}

   ObjectSet(name,OBJPROP_PRICE2,p1);
   ObjectSet(name,OBJPROP_TIME2,b);
   if(i>23)ObjectSet(name,OBJPROP_RAY,false);
   else ObjectSet(name,OBJPROP_RAY,true);

   ObjectSet(name,OBJPROP_COLOR,color1);
   ObjectSet(name,OBJPROP_WIDTH,width1);
   ObjectSet(name,OBJPROP_STYLE,style1);
   string sObjDesc = StringConcatenate("",des);
   ObjectSetText(name, sObjDesc,10,"Times New Roman",Black);
   ObjectSet(name,OBJPROP_BACK,true);
}

//-----------------------------------------------------------------------------------------
//--------------------------Draw Label-----------------------------------------------------
int drawL(string name,int disx,int disy,string txt,int size_font,string type_font,color color1,int corner)
{
 ObjectCreate(name,OBJ_LABEL,0,0,0,0);
 ObjectSet(name,OBJPROP_XDISTANCE,disx);
 ObjectSet(name,OBJPROP_YDISTANCE,disy);
 ObjectSetText(name,txt,size_font,type_font,color1);
ObjectSet(name,OBJPROP_CORNER,corner);
}

//-----------------------------------------------------------------------------------------
//---------------------------Draw Rectangle-----------------------------------------
void Rec(string name,int i,double p1,double p2,int width1,color color1,int style1)
{
datetime b;

if(TimeDayOfWeek(Time[i])!=start_week_day)
  {
    if(time_hour!=0)  b=StrToTime(TimeToStr(Time[i]+60*60*24,TIME_DATE)+" "+(time_hour-1));
      else b=StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+"23:00");
  }
  else
  {
   if(time_hour!=0)  {b=StrToTime(TimeToStr(Time[i]+60*60*24,TIME_DATE)+" "+(time_hour-1)); }
   if(time_hour!=0&&TimeHour(Time[i])==0&&start_week_hour==0)  {b=StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+(time_hour-1)); }
   if(time_hour==0) b=StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+"23:00");
  }

if((TimeDayOfWeek(Time[i])==start_week_day&&TimeHour(Time[i])==0)) name=name+" ";

   ObjectCreate(name,OBJ_RECTANGLE,0,0,0,0,0);
   ObjectSet(name,OBJPROP_PRICE1,p1);

   if((TimeDayOfWeek(Time[i])==start_week_day&&TimeHour(Time[i])==0)){ObjectSet(name,OBJPROP_TIME1,StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+0)); }
   else {ObjectSet(name,OBJPROP_TIME1,StrToTime(TimeToStr(Time[i],TIME_DATE)+" "+time_hour));}

   ObjectSet(name,OBJPROP_PRICE2,p2);
   ObjectSet(name,OBJPROP_TIME2,b);

   ObjectSet(name,OBJPROP_COLOR,color1);
   ObjectSet(name,OBJPROP_WIDTH,width1);
   ObjectSet(name,OBJPROP_STYLE,style1);
}

//+------------------------------------------------------------------+
//+-------------------------Trim String------------------------------
int trim(double h)
{double last;
   string no=DoubleToStr(h,0);
   string nn[];
   int i;
   last=h;
   while(last>9)
   {last=0;
     for(i=0;i<StringLen(no);i++)
     {
        nn[i]=StringSubstr(no,i,1);
        last=StrToDouble(nn[i])+last;
     }
     no=DoubleToStr(last,0);
   }

   return(last);
}

//-----------------------------------------------------------------------------------------
int drawPrice(string name,double p1,color color1,int width1,int style1,int i,int d)
{
 ObjectCreate(name,OBJ_ARROW,0,0,0);
 ObjectSet(name,OBJPROP_ARROWCODE,6);
 ObjectSet(name,OBJPROP_TIME1,StrToTime(TimeToStr(iTime(NULL,PERIOD_H1,i)+d,TIME_DATE|TIME_MINUTES)));
 ObjectSet(name,OBJPROP_PRICE1,p1);
 ObjectSet(name,OBJPROP_COLOR,color1);
 ObjectSet(name,OBJPROP_WIDTH,width1);
 ObjectSet(name,OBJPROP_STYLE,style1);
 ObjectSetText(name,DoubleToStr(p1,Digits),10,"Arial",color1);
}

//-------------------------Object Delete----------------------------------------------------
int deletobject()
{
//----
  int i;
string a;
for (i=Bars;i>=0;i--)
 {
 if((TimeDayOfWeek(Time[i])==start_week_day&&TimeHour(Time[i])==0)) a=" ";
 else a="";

   // Delete HL1-HL5 objects
   ObjectDelete("HL1"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("HL2"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("HL3"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("HL4"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("HL5"+" "+TimeToStr(Time[i],TIME_DATE)+a);

   // Delete HL10-HL14 objects
   ObjectDelete("HL10"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("HL11"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("HL12"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("HL13"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("HL14"+" "+TimeToStr(Time[i],TIME_DATE)+a);

   // Delete LL1-LL5 objects
   ObjectDelete("LL1"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("LL2"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("LL3"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("LL4"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("LL5"+" "+TimeToStr(Time[i],TIME_DATE)+a);

   // Delete LL10-LL14 objects
   ObjectDelete("LL10"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("LL11"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("LL12"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("LL13"+" "+TimeToStr(Time[i],TIME_DATE)+a);
   ObjectDelete("LL14"+" "+TimeToStr(Time[i],TIME_DATE)+a);

ObjectDelete("Magnetic Area"+" "+TimeToStr(Time[i],TIME_DATE)+a);

 }
 ObjectDelete("Range1");
 ObjectDelete("Range12");
 ObjectDelete("Range2");
 ObjectDelete("Range22");
 ObjectDelete("Range3");
 ObjectDelete("Range32");
 ObjectDelete("Range4");
 ObjectDelete("Range42");
 ObjectDelete("Range5");
 ObjectDelete("Range52");
 ObjectDelete("===");
 ObjectDelete("Pw_High");
 ObjectDelete("Pw_Low");
 ObjectDelete("Pw_Open");
 ObjectDelete("Pw_Highh");
 ObjectDelete("Pw_Loww");
 ObjectDelete("Pw_Openn");

 if(show_price_Label==true)
 {
 // Delete price labels for LL1-LL5
 ObjectDelete("price_LL1");
 ObjectDelete("price_LL2");
 ObjectDelete("price_LL3");
 ObjectDelete("price_LL4");
 ObjectDelete("price_LL5");

 // Delete price labels for LL10-LL14
 ObjectDelete("price_LL10");
 ObjectDelete("price_LL11");
 ObjectDelete("price_LL12");
 ObjectDelete("price_LL13");
 ObjectDelete("price_LL14");

 // Delete price labels for HL1-HL5
 ObjectDelete("price_HL1");
 ObjectDelete("price_HL2");
 ObjectDelete("price_HL3");
 ObjectDelete("price_HL4");
 ObjectDelete("price_HL5");

 // Delete price labels for HL10-HL14
 ObjectDelete("price_HL10");
 ObjectDelete("price_HL11");
 ObjectDelete("price_HL12");
 ObjectDelete("price_HL13");
 ObjectDelete("price_HL14");

 ObjectDelete("Today_Range");
 ObjectDelete("Today_Range_");
 ObjectDelete("Pre_day_Range_");
 ObjectDelete("Pre_day_Range");
}

return(0);
}