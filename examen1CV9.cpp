#include <stdio.h>
#include <conio.h>
#include <stdlib.h>

main()
{
      FILE *ar;
      char cad[100],cadenas[1000]={""};
      int i,c,cd=0,pal=-1;
      printf("Cadena a verificar: ");
      gets(cad);

         
      for(i=0;i<100;i++)
      {
       if(cad[i]=='\0')
             break;
         if((cad[i]==32 && (cad[i+1]==65 || cad[i+1]==97))||((cad[i]==65 || cad[i]==97) && i==0))
         {  cd++;         
           for(c=i;c<1000;c++)
           {
             pal++;
             if(cad[c]=='\0' || cad[c+1]==32)
             {
               cadenas[pal] = ')';
               break;
             }
             if(cad[i]==32)            
              cadenas[pal] = cad[c+1];
             else
              cadenas[pal] = cad[c];
           }
         }
      }
      
      printf("Numero de Palabras: %d\n",cd);
      
      for(i=0;i<=1000;i++)
         {
          if(cadenas[i]=='\0')
             break;     
                           
           if(cadenas[i]==')')
            printf("\n");
           else
           printf("%c",cadenas[i]);
         }

       if((ar=fopen("C:\\Users\\escom\\Desktop\\exaaaaaaaaaaamen.txt","w"))==NULL)
       {
        fprintf(stderr,"Error al abrir archivo");
        exit(1);
       }
       fprintf(ar,"Numero de Palabras: %d\n",cd);
       for(i=0;i<=1000;i++)
       {
          if(cadenas[i]=='\0')
             break;     
                           
           if(cadenas[i]==')')
            fprintf(ar,"\n");
           else
           fprintf(ar,"%c",cadenas[i]);
       }
       fclose(ar);
      getch();
}
