/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Codejudge Compiler Server: Compiler for the Python language
 */

package codejudge.compiler.languages;

import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;

import codejudge.compiler.TimedShell;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;

public class Python extends Language {
	
	String file, contents, dir;
	int timeout;
	
	public Python(String file, int timeout, String contents, String dir) {
		this.file = file;
		this.timeout = timeout;
		this.contents = contents;
		this.dir = dir;
	}

        // Since Python works on an interpreter, there is no "execute" function involved
	public void compile(Language l) {
		try {
                      
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file)));
			out.write(contents);
			out.close();
			// create the execution script
			out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/run.bat")));
			out.write("cd \"" + dir +"\"\n");
			//out.write("chroot .\n");
			out.write("python " + file + "< testcase.txt > out.txt 2>err.txt");
			out.close();
                        BufferedReader in = new BufferedReader(new FileReader(dir+"\\in.txt"));
                        
                        String fileName=file;
                        File file = new File(dir + "\\testcase.txt");    
                        String fileContent=in.readLine();
                        int num = fileContent.length() - fileContent.replaceAll(";","").length();
                        BufferedWriter testOut = new BufferedWriter(new FileWriter(file,false));    
                        String Output = "";
                        String line = "";
                        
		  while(num!=0)
                  {     
                      System.out.println("inside while\n");
                        testOut = new BufferedWriter(new FileWriter(file,false));
                        int firstOccur = fileContent.indexOf(";");
                        String testCase = fileContent.substring(0, firstOccur);
                        testOut.write(testCase);
                        testOut.close();
                        fileContent = fileContent.replaceAll(testCase+";","");
                        num--; 
			Runtime r = Runtime.getRuntime();
			Process p = r.exec(dir + "\\run.bat");//"chmod +x " + 
                        
			//p.waitFor();
			//p = r.exec(dir + "\\run.bat"); // execute the script
                       
			TimedShell shell = new TimedShell(this, p, timeout);
			shell.start();
			p.waitFor();	
                        BufferedReader readOutput = new BufferedReader(new FileReader(dir + "\\out.txt"));
                            
                       System.out.println("just checking \n");
                  if(l.timedout){
                            Output = Output + "timeout;\n";
                        }
                        else
                        {
                            
                        line = readOutput.readLine();      
                       System.out.println("inside else-python\n");
                        while(line!=null)
                       {
                           
                           Output = Output+line+"\n";
                           
                           line = readOutput.readLine();
                       } 
                        Output = Output + ";\n" ;
                       }
                  }
                       System.out.println("output -"+ Output);// To debug 
                     //Output = Output+"\n";
                        Output = Output.substring(0, Output.length()-1);
                        System.out.println(Output);            
                        BufferedWriter writeOutput = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\out.txt")));
                        writeOutput.write(Output);
                        writeOutput.close();
              /* BufferedReader readOutput = new BufferedReader(new FileReader(dir + "\\out.txt"));
               System.out.println(readOutput.readLine()); To debug*/
                }   
                  
                
                catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
                
        
                
       }     
        
  
                     /*   Runtime r = Runtime.getRuntime();
			Process p = r.exec(dir + "/run.bat");//"chmod +x "
			p.waitFor();
			p = r.exec(dir + "/run.bat"); // execute the script
			TimedShell shell = new TimedShell(this, p, 3000);
			shell.start();
			p.waitFor();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}*/
	

	public void execute(Language l) {
		// nothing to be done here
	}
}
